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
        return redirect()->route('user-dashboard')->with('message', 'Payment cancel. Go to account > order section for payment or contact sales support');
    }


    public function ipn(Request $request)
    {
        dd($request);
    }
}
