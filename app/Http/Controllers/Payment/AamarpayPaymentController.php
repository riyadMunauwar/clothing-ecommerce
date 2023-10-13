<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payment;

class AamarpayPaymentController extends Controller
{
    

    public function success(Request $request)
    {
        return $this->aamarpayPaymentSuccessHandeler($request);
    }


    public function failed(Request $request)
    {
        $this->aamarpayPaymentFailerHandeler($request);
    }


    public function cancel()
    {
        return redirect()->route('user-dashboard')->with('message', 'Payment cancel. Go to account > orders section for payment or contact sales support');
    }


    public function ipn(Request $request)
    {
        dd($request);
    }


    private function aamarpayPaymentFailerHandeler($request)
    {
        $pay_status = $request->pay_status; 
        $card_trx = $request->bank_txn;
        $card_type = $request->card_type;
        $pay_time = $request->pay_time;
        $currency = $request->currency;
        $payment_id = $request->mer_txnid;
        $amount = (double) $request->amount;


        if($pay_status === 'Failed'){

            $payment = Payment::find($payment_id);

            $payment->provider = 'Ammarpay';

            $payment->method = $card_type;

            $payment->amount = $amount;

            $payment->currency = $currency;

            $payment->status = 'failed';

            $payment->save();

            return redirect()->route('user-dashboard')->with('message', "Payment failed. Please contact to our technical support team");
        }

    }

    private function aamarpayPaymentSuccessHandeler($request)
    {
        $pay_status = $request->pay_status; 
        $card_trx = $request->bank_txn;
        $card_type = $request->card_type;
        $pay_time = $request->pay_time;
        $currency = $request->currency;
        $payment_id = $request->mer_txnid;
        $amount = (double) $request->amount;


        if($pay_status === 'Successful'){

            $payment = Payment::with('order')->find($payment_id);

            $payment->provider = 'Ammarpay';

            $payment->method = $card_type;

            $payment->amount = $amount;

            $payment->currency = $currency;

            $payment->status = 'success';

            $payment->save();

            $order = $payment->order;

            if($amount < $order->total_price){
                $order->payment_status = 'partially-paid';
            }else {
                $order->payment_status = 'paid';
            }

            $order->save();

            return redirect()->route('user-dashboard')->with('success', "Thank you for choosing us for your recent purchase. Your order #{$order->order_no} has been successfully completed, and we are thrilled to have you as our valued customer.");

        }


    }
}
