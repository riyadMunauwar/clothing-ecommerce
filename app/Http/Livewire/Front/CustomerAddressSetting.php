<?php

namespace App\Http\Livewire\Front;

use Livewire\Component;
use App\Models\Address;

class CustomerAddressSetting extends Component
{
    public $addresses = [];

    public function mount()
    {
        $this->addresses = Address::where('user_id', auth()->id())->get();
    }

    public function render()
    {
        return view('front.components.customer-address-setting');
    }
}
