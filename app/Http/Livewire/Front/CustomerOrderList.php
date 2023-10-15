<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;

class CustomerOrderList extends Component
{
    public $orders = [];
    
    public function render()
    {
        return view('front.components.customer-order-list');
    }
}
