<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'code',
        'type',
        'amount',
        'start_date',
        'end_date',
        'description',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    // Model Scrop

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeValid($query)
    {
        $currentDate = Carbon::today();
        return $query->where('start_date', '<=', $currentDate)
                     ->where('end_date', '>=', $currentDate);
    }

    public function isValidCoupon()
    {
        $presentTimeAndDate = Carbon::now();

        return $presentTimeAndDate->between($this->start_date, $this->end_date->addDay());
    }


    public function getCouponDiscountAmount($orderTotal)
    {
        if(!$orderTotal) return null;

        $discountAmount = $this->amount;

        if($this->type === 'fixed') return $discountAmount;

        if($this->type === 'percent') {
            return ($discountAmount * $orderTotal) / 100;
        }

        return 0;
    }
}
