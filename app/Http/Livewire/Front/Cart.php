<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Services\Cart\CartService;

class Cart extends Component
{

    use WithSweetAlert;

    public $cart_items = [];

    public $sub_total = 0;

    public $total = 0;

    protected $listeners = [
        'onCartItemChanges' => '$refresh',
    ];

    public function render()
    {
        $this->prearedCartItemsData();
        return view('front.components.cart');
    }

    public function prearedCartItemsData()
    {
        $cart = new CartService();

        $this->cart_items = $cart->all();
        $this->cart_items_count = $cart->itemsCount();
        $this->sub_total = $cart->subTotal();
    }


    public function removeCartItemByRowId($rowId)
    {
        $cart = new CartService();

        $result = $cart->remove($rowId);

        if($result['isError']) {
            return $this->error($result['message'], '');
        }else {
            $this->emit('onCartItemChanges');
            return $this->success($result['message'], '');
        }
    }
}
