<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetCheckoutPageController extends Controller
{
    public function __invoke()
    {
        if(!auth()->check()){
            return redirect()->route('register')->with(['redirect' => 'checkout']);
        }

        $isSelect = session()->has('shipping_option') ? session()->get('shipping_option') : false;

        if(!$isSelect){
            return redirect()->route('cart')->with('message', 'Please select a shipping method');
        }

        return view('front.pages.checkout');
    }
}
