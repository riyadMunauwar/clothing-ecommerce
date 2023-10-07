<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Services\Cart\CartService;
use App\Services\Payment\PaymentContext;

class Checkout extends Component
{

    public $subTotal = 0;
    public $shippingCost = 0;

    public function mount()
    {
        $cart = new CartService();
        
        $this->subTotal = $cart->subTotal();
    }

    public function render()
    {
        return view('front.components.checkout');
    }


    public function startPayment()
    {
        $payment = new PaymentContext('aamarpay');

        $response = $payment->pay(1000.000, []);

        dd($response);

        redirect()->away($response['payment_url']);
    }
}
