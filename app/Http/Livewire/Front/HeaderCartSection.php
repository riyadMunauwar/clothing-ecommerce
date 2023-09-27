<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Services\Cart\CartService;

class HeaderCartSection extends Component
{
    use WithSweetAlert;

    public $cart_items = [];

    public $cart_items_count = 0;

    public $sub_total = 0;


    protected $listeners = [
        'onCartItemChanges' => 'prearedCartItemsData',
    ];

    public function mount()
    {
        $cart = new CartService();
        $this->prearedCartItemsData($cart);
    }

    public function render()
    {
        return view('front.components.header-cart-section');
    }

    public function prearedCartItemsData(CartService $cart)
    {
        $this->cart_items = $cart->all();
        $this->cart_items_count = $cart->itemsCount();
        $this->sub_total = $cart->subTotal();
    }

    public function removeCartItemByRowId($rowId)
    {
        $cart = new CartService();

        dd($rowId);
        $result = $cart->remove($rowId);

        dd($result);
    }
}
