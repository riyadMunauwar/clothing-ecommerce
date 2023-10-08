<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Services\Cart\CartService;
use App\Services\Payment\PaymentContext;

class Checkout extends Component
{

    public $cartItems = [];
    public $subTotal = 0;
    public $shippingCost = 0;

    public function mount()
    {
        $this->initData();
    }

    public function render()
    {
        return view('front.components.checkout');
    }


    public function startPayment()
    {
        $payment = new PaymentContext('aamarpay');

        $response = $payment->pay(1000.000, []);


        redirect()->away($response['payment_url']);
    }


    private function initData()
    {
        $cart = new CartService();
        
        $this->cartItems = $cart->all();
        $this->subTotal = $cart->subTotal();
    }
}
