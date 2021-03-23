<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;
use App\course_user;

use MercadoPago\Payment;
use MercadoPago\SDK;
use Illuminate\Support\Facades\Config;


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
}
