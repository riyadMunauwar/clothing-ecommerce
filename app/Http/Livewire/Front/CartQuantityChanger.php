<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Traits\WithSweetAlertToast;
use App\Services\Cart\CartService;

class CartQuantityChanger extends Component
{
    use WithSweetAlert;

    public $qty;
    public $rowId;
    
    public function mount($qty, $rowId)
    {
        $this->qty = $qty;
        $this->rowId = $rowId;
    }

    public function render()
    {
        return view('front.components.cart-quantity-changer');
    }

    public function updatedQty($value)
    {
        $this->changeQty($value);
    }

    private function changeQty($qty)
    {
        $cart = new CartService();

        $result = $cart->bulkIncrementOrDrecrement($this->rowId, $qty);

        if($result['isError']) {
            return $this->error($result['message'], '');
        }else {
            $this->emit('onCartItemChanges');
            return $this->success($result['message'], '');
        }
    }

}
