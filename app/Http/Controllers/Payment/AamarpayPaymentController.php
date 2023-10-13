<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

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
        $amount = $request->amount;


        if($pay_status === 'Successful'){

            $payment = Payment::with('order')->find($payment_id);

            $payment->provider = 'Ammarpay';

            $payment->method = $card_type;

            $payment->amount = $amount;

            $payment->currency = $currency;

            $payment->status = 'success';

            $payment->save();

            $order = $payment->order;


            dd((double) $amount);
            // if((double) $amount);


        }

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
