<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AamarpayPaymentController extends Controller
{
    

    public function success(Request $request)
    {
        $pay_status = $request->pay_status; 
        $card_trx = $request->bank_txn;
        $card_type = $request->card_type;
        $pay_time = $request->pay_time;
        $currency = $request->currency;
        $payment_id = $request->mer_txnid;



        dd($pay_status, $card_trx, $card_type, $pay_time, $currency, $payment_id);
    }


    public function failed(Request $request)
    {
        $pay_status = $request->pay_status; 
        $card_trx = $request->bank_txn;
        $card_type = $request->card_type;
        $pay_time = $request->pay_time;
        $currency = $request->currency;
        $payment_id = $request->mer_txnid;



        dd($pay_status, $card_trx, $card_type, $pay_time, $currency, $payment_id);
    }


    public function cancel()
    {
        return redirect()->route('user-dashboard')->with('message', 'Payment cancel. Go to account > orders section for payment or contact sales support');
    }


    public function ipn(Request $request)
    {
        dd($request);
    }
}
