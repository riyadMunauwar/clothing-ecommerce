<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Services\Cart\CartService;
use App\Services\Payment\PaymentContext;

class Checkout extends Component
{

    public $payment_method_option;
    public $cartItems = [];
    public $subTotal = 0;
    public $total = 0;
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
        $this->shippingCost = session()->get('shipping_cost');

        $cart = new CartService();
        
        $this->cartItems = $cart->all();
        $this->subTotal = $cart->subTotal();
        $this->total = $cart->total(discount: 0, shippingCost: $this->shippingCost);
  
    }
}
