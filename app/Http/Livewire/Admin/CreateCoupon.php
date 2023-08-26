<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Coupon;
use App\Traits\WithSweetAlert;

class CreateCoupon extends Component
{

    use WithSweetAlert;

    public $name;
    public $code;
    public $type = 'percent';
    public $amount;
    public $start_date;
    public $end_date;
    public $description;
    public $is_active = false;

    protected $rules = [
        'name' => ['nullable', 'string'],
        'code' => ['required', 'string'],
        'type' => ['required', 'in:fixed,percent'],
        'amount' => ['required', 'numeric'],
        'start_date' => ['required', 'date_format:Y-m-d'],
        'end_date' => ['required', 'date_format:Y-m-d'],
        'description' => ['nullable', 'string'],
        'is_active' => ['required', 'boolean'],
    ];
    
    public function render()
    {
        return view('admin.components.create-coupon');
    }

    public function createCoupon()
    {
        $this->validate();

        $coupon = new Coupon();

        $coupon->name = $this->name;
        $coupon->code = $this->code;
        $coupon->type = $this->type;
        $coupon->amount = $this->amount;
        $coupon->start_date = $this->start_date;
        $coupon->end_date = $this->end_date;
        $coupon->description = $this->description;
        $coupon->is_active = $this->is_active;

        if($coupon->save())
        {
            $this->reset();
            $this->emit('onCouponCreated');
            return $this->success('Created', '');
        }

        return $this->error('Failed', 'failed to create coupon.');
    }

}
