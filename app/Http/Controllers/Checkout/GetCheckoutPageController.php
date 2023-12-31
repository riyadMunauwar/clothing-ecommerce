<?php

namespace App\Http\Controllers\Checkout;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetCheckoutPageController extends Controller
{
    public function __invoke()
    {
        if(!auth()->check()){
            return redirect()->route('register', ['redirect' => 'checkout'])->with('message', "If you're new to our site, please proceed by creating an account to complete. If you already have an account with us, please log in to continue with your purchase.");
        }

        $isSelect = session()->has('shipping_option') ? session()->get('shipping_option') : false;

        if(!$isSelect){
            return redirect()->route('cart')->with('message', 'Please select a shipping option');
        }

        return view('front.pages.checkout');
    }
}
