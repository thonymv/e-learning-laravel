<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment as PaymentPP;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use Illuminate\Support\Facades\Config;


class PaypalCreatePay extends Controller
{
   private $payConfig;
   public function CrearPago(Request $request)
   {
    $payConfig = Config::get('pagos');
    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
          $payConfig["client_id"] ,
          $payConfig["secret"] 
        )
      );
    $inf =  $request->all();
    $precio = '10.20';
    $payer = new Payer();
    $payer->setPaymentMethod("paypal");

    $item1 = new Item();
        $item1->setName('Ground Coffee 40 oz')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($precio);
    $itemList = new ItemList();
    $itemList->setItems(array($item1));

    $amount = new Amount();
    $amount->setCurrency("USD")
    ->setTotal($precio);

    $transaction = new Transaction();
    $transaction->setAmount($amount)
        ->setItemList($itemList)
        ->setDescription("Payment description");

    $baseUrl = $request->getSchemeAndHttpHost()."/academia-qa-laravel/public/api";
    $redirectUrls = new RedirectUrls();
    $redirectUrls->setReturnUrl("$baseUrl/paypal/execute")
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

   function EjecutarPago(Request $request)
   {
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
      return "<title>success</title>";
    }catch(Exception $ex){
      return "<title>failed</title>";

    }
   }

}
