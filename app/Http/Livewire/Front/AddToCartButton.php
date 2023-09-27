<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Services\Cart\CartService;

class AddToCartButton extends Component
{
    use WithSweetAlert;
    
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

        $result = $cart->add($this->productId, null, 1);

        if(!$result['isError']){
            return $this->success('Item added to cart', $result['message']);
        }else {
            return $this->error('Woops !', $result['message']);
        }
    }
}
