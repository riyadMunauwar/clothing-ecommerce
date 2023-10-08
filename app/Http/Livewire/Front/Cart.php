<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Services\Cart\CartService;

class Cart extends Component
{

    use WithSweetAlert;

    public $shipping_method;

    public $cart_items = [];

    public $sub_total = 0;

    public $total = 0;

    protected $listeners = [
        'onCartItemChanges' => '$refresh',
    ];

    public function mount()
    {
        $this->setPreviousSelectedShippingOption();
    }

    public function render()
    {
        $this->prearedCartItemsData();
        return view('front.components.cart');
    }


    public function goToCheckout()
    {
        if(!$this->shipping_method){
            return $this->info('Please select a shipping method', '');
        }

        $this->setupShippingOption();

        return redirect()->route('checkout');
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

    public function removeAll()
    {
        $cart = new CartService();

        $result = $cart->removeAll();

        if($result['isError']) {
            return $this->error($result['message'], '');
        }else {
            $this->emit('onCartItemChanges');
            return $this->success($result['message'], '');
        }
    }


    private function setPreviousSelectedShippingOption()
    {
        $shipping_cost = session()->has('shipping_cost') ? session()->get('shipping_cost') : 0;
        
        $shipping_option = session()->has('shipping_option') ? session()->get('shipping_option') : '';

        if($shipping_cost && $shipping_option){
            $this->shipping_method = "{$shipping_option}-{$shipping_cost}";
        }
    }

    private function setupShippingOption()
    {
        $shipping_cost = $this->getShippingCost($this->shipping_method);
    
        $shipping_option = $this->getShippingProvider($this->shipping_method);

        session()->put('shipping_cost', $shipping_cost);
        session()->put('shipping_option', $shipping_option);
    }

    private function getShippingCost($str)
    {
        return (int) explode('-', $str)[1];
    }

    private function getShippingProvider($str)
    {
        return explode('-', $str)[0];
    }

}
