<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class CustomerOrderList extends Component
{
    use WithPagination;

    public function render()
    {
        return view('front.components.customer-order-list', [
            'orders' => $this->getCurrentUserOrders(),
        ]);
    }


    public function getCurrentUserOrders()
    {
        return Order::withCount('orderItems')->where('user_id', auth()->id())->latest()->paginate(6);
    }


}
