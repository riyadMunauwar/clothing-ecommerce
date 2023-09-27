<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Services\Cart\CartService;

class AddToCartButton extends Component
{
    protected $productId;
 


    public function render()
    {
        return view('front.components.add-to-cart-button');
    }

    public function addToCartHandeler()
    {
        dd($this->productId);

        $result = $this->cart->add($productId, null, 1);

        dd($result);
    }
}
