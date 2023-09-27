<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Services\Cart\CartService;

class AddToCartButton extends Component
{
    public $productId;
 

    public function mount($productId)
    {
        $this->productId = $productId;
    }

    public function render()
    {
        return view('front.components.add-to-cart-button');
    }

    public function addToCartHandeler()
    {
        $cart = new CartService();

        $result = $this->cart->add($productId, null, 1);

        dd($result);
    }
}
