<?php

namespace App\Observers;

use App\Models\Coupon;
use App\Actions\Cache\RemoveCachedSingleCoupon;

class CouponObserver
{
    /**
     * Handle the Coupon "created" event.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return void
     */
    public function created(Coupon $coupon)
    {
        
    }

    /**
     * Handle the Coupon "updated" event.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return void
     */
    public function updated(Coupon $coupon)
    {
        new RemoveCachedSingleCoupon($coupon->cache_key ?? '');
    }

    /**
     * Handle the Coupon "deleted" event.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return void
     */
    public function deleted(Coupon $coupon)
    {
        new RemoveCachedSingleCoupon($coupon->cache_key ?? '');
    }

    /**
     * Handle the Coupon "restored" event.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return void
     */
    public function restored(Coupon $coupon)
    {
        //
    }

    /**
     * Handle the Coupon "force deleted" event.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return void
     */
    public function forceDeleted(Coupon $coupon)
    {
        //
    }
}
