<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;

class DashboardLatestOrderListBox extends Component
{
    public $orders = [];


    public function mount()
    {
        $this->orders = Order::latest()->limit(9)->get();
    }

    public function render()
    {
        return view('admin.components.dashboard-latest-order-list-box');
    }
}
