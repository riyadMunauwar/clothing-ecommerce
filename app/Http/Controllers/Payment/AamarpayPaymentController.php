<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AamarpayPaymentController extends Controller
{
    

    public function success(Request $request)
    {
        dd($request);
    }


    public function failed(Request $request)
    {
        dd($request);
    }


    public function cancel()
    {
        return redirect()->route('cart')->with('message', 'Payment cancel');
    }


    public function ipn(Request $request)
    {
        dd($request);
    }
}
