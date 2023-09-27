<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Services\Cart\CartService;

class AddToCartButton extends Component
{
    protected $productId;
    protected $cart;

    public function mount()
    {
        $this->cart = new CartService();
    }

    public function render()
    {
        return view('front.components.add-to-cart-button');
    }

    public function addToCartHandeler()
    {
        dd($this->cart);
        
        $result = $this->cart->add($productId, null, 1);

        dd($result);
    }
}
