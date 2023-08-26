<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Order;

class CurrentMonthSalesChart extends Component
{
    public $salesData;

    public function mount()
    {
        $this->salesData = Order::getCurrentMonthSales();
    }

    public function render()
    {
        return view('admin.components.current-month-sales-chart');
    }
}
