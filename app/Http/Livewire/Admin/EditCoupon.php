<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Traits\WithSweetAlert;
use App\Models\Coupon;

class EditCoupon extends Component
{
    use WithSweetAlert;

    public $is_edit_mode_on = false;

    public $coupon;

    public $start_date;
    public $end_date;


    protected $rules = [
        'coupon.name' => ['nullable', 'string'],
        'coupon.code' => ['required', 'string'],
        'coupon.type' => ['required', 'in:fixed,percent'],
        'coupon.amount' => ['required', 'numeric'],
        'start_date' => ['required', 'date_format:Y-m-d'],
        'end_date' => ['required', 'date_format:Y-m-d'],
        'coupon.description' => ['nullable', 'string'],
        'coupon.is_active' => ['required', 'boolean'],
    ];


    protected $listeners = [
        'onCouponEdit' => 'enableCouponEditMode',
    ];

    public function render()
    {
        return view('admin.components.edit-coupon');
    }

    public function updateCoupon()
    {

        $this->validate();

        $this->coupon->start_date = $this->start_date;
        $this->coupon->end_date = $this->end_date;

        if($this->coupon->save()){

            $this->reset();

            $this->is_edit_mode_on = false;

            $this->emit('onCouponUpdated');

            return $this->success('Updated', 'Coupon updated successfully');
        }
        
        return $this->error('Failed', 'Something went wrong. Try again !');

    }


    public function enableCouponEditMode($id)
    {

        $this->coupon = Coupon::find($id);
        $this->start_date = $this->coupon->start_date->format('Y-m-d');
        $this->end_date = $this->coupon->end_date->format('Y-m-d');

        $this->is_edit_mode_on = true;

    }


    public function cancelEditMode()
    {
        $this->reset();
        $this->is_edit_mode_on = false;
    }
}
