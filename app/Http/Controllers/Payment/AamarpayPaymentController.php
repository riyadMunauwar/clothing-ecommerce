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
        dd('cancel url');
    }


    public function ipn(Request $request)
    {
        dd($request);
    }
}
