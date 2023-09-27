<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class AddToCartButton extends Component
{
    public $productId;

    public function render()
    {
        return view('front.components.add-to-cart-button');
    }
}
