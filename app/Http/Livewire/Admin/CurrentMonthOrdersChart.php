<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;

class CurrentMonthOrdersChart extends Component
{
    public $ordersData;

    public function mount()
    {
        $this->ordersData = Order::getCurrentMonthOrders();
    }

    public function render()
    {
        return view('admin.components.current-month-orders-chart');
    }
}
