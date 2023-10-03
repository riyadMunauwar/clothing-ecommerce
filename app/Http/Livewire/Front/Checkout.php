<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Services\Cart\CartService;

class Checkout extends Component
{

    public $subTotal = 0;
    public $shippingCost = 0;

    public function mount()
    {
        $this->subTotal = $cart->subTotal();
    }

    public function render()
    {
        return view('front.components.checkout');
    }
}
