<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\course_user;
use Illuminate\Support\Facades\Config;

//sdk mp
use MercadoPago\Payment;
use MercadoPago\SDK;

//sdk paypal
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment as PaymentPP;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;




class CourseController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        return Course::create($data);
    }

    public function getCourses(Request $request)
    {
        $courses = Course::inRandomOrder()->get();
        foreach ($courses as $course) {
            $course["locked"] = $course->users()->find(auth()->user()->id)?false:true;
            foreach ($course->modules as $module) {
                $module["lessons"] = $module->lessons()->where('status',1)->get();
                foreach ($module->lessons as $lesson) {
                    $userInLesson = $lesson->users()->find(auth()->user()->id);
                    if($userInLesson){
                        $lesson["percent"] = $userInLesson->pivot->percent;
                    }
                }
            }
        }   
        return response()->json($courses,200);
    }
    
    public function getCourse(Request $request,$id)
    {
        $course = Course::find($id);
        $course["modules"] = $course->modules()->where('status',1)->get();
        $course["locked"] = $course->users()->find(auth()->user()->id)?false:true;
        foreach ($course->modules as $module) {
            $module["lessons"] = $module->lessons()->where('status',1)->get();
            foreach ($module->lessons as $lesson) {
                $userInLesson = $lesson->users()->find(auth()->user()->id);
                if($userInLesson){
                    $lesson["percent"] = $userInLesson->pivot->percent;
                }
            }
        }
        return response()->json($course,200);
    }

    public function paymentMp(Request $request,$id,$id_pay){

        try {
            $payment = $this->search($id_pay);
            $course = Course::find($id);
            if (
                $payment != null && //si existe el pago en mp
                $payment->status == "approved" && //si el pago fue aprobado
                course_user::where('id_pay',$id_pay)->first() === null && //si el pago no ha sido registrado antes
                $course != null &&//si el curso ingresado existe
                floatval($course["price"]) == floatval($payment->transaction_amount)//si el precio del curso coincide con el precio cancelado
            ) {
                return course_user::create([
                    'user_id' => auth()->user()->id, 
                    'course_id' => $course["id"],
                    'id_pay' => $payment->id,
                    'method_pay' => 'mp'
                ]);//crear pago
            }
        } catch (Exception $ex) {
            return response()->json(["response"=>"error","err"=>$ex->getMessage()],500);
        }
        
        return response()->json(["response"=>"error"],400);
        
    }

    public function paymentPP(Request $request,$id)
    {
        $course = Course::find($id);
        return $this->CrearPago($course,$request);
    }
    

    public function search($id_pay)
    {
        $config = Config::get('services')["mp"];
        SDK::setAccessToken($config["token"]);
        $search = Payment::search(array(
            "id" => $id_pay
        ))->getArrayCopy();
        if($search){
            return $search[0];
        }else{
            return null;
        }
    }

    public function CrearPago($course,Request $request)
    {
        $payConfig = Config::get('pagos');
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $payConfig["client_id"],
                $payConfig["secret"] 
            )
        );
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item1 = new Item();
            $item1->setName($course["name"])
                ->setCurrency('USD')
                ->setQuantity(1)
                ->setPrice($course["price"]);
        $itemList = new ItemList();
        $itemList->setItems(array($item1));

        $amount = new Amount();
        $amount->setCurrency("USD")
        ->setTotal($course["price"]);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription($course["description"]);

        $baseUrl = $request->getSchemeAndHttpHost()."/academia-qa-laravel/public/api";
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/course/".$course["id"]."/pp/".auth()->user()->id)
            ->setCancelUrl("$baseUrl/paypal/cancel");

        $payment = new PaymentPP();
        $payment->setIntent("sale")
        ->setPayer($payer)
        ->setRedirectUrls($redirectUrls)
        ->setTransactions(array($transaction));

        $request = clone $payment;

        try {
            $payment->create($apiContext);
        } catch (Exception $ex) {
            ResultPrinter::printError("Created Payment Order Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
            exit(1);
        }

        $approvalUrl = $payment->getApprovalLink();

        return redirect($approvalUrl);

    }

    function paymentPPExec(Request $request,$id,$id_user)
    {
        $course = Course::find($id);
        $payConfig = Config::get('pagos');
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                $payConfig["client_id"] ,
                $payConfig["secret"] 
            )
        );
        $paymentId = $request->input('paymentId');
        $payment = PaymentPP::get($paymentId, $apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        try {
            $result = $payment->execute($execution, $apiContext);
            if ($result) {
                $createPay = course_user::create([
                    'user_id' => $id_user, 
                    'course_id' => $course["id"],
                    'id_pay' => $paymentId,
                    'method_pay' => 'pp'
                ]);
                return "<title>".$createPay["course_id"]."</title>";
            }else{
                return "<title>failed</title>";
            }
        }catch(Exception $ex){
            return "<title>failed</title>";
        }
    }

}
