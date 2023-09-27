<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Services\Cart\CartService;

class Header extends Component
{
    use WithSweetAlert;

    public $cart_items = [];

    public $cart_items_count = 0;

    protected $cart;

    protected $rules = [
        'onCartItemChanges' => 'prearedCartItemsData',
    ];

    public function mount()
    {
        $this->cart = new CartService();
        $this->prearedCartItemsData();
    }

    public function render()
    {
        return view('front.components.header');
    }

    public function prearedCartItemsData()
    {
        $this->cart_items = $this->cart->all();
        $this->cart_items_count = $this->cart->itemsCount();
    }
}
