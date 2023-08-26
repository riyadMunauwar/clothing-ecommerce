<?php

namespace App\Observers;

use App\Models\Variation;
use Illuminate\Support\Facades\Cache;

class VariationObserver
{
    /**
     * Handle the Variation "created" event.
     *
     * @param  \App\Models\Variation  $variation
     * @return void
     */
    public function created(Variation $variation)
    {
        //
    }

    /**
     * Handle the Variation "updated" event.
     *
     * @param  \App\Models\Variation  $variation
     * @return void
     */
    public function updated(Variation $variation)
    {
        $cacheKey = $variation->product->cache_key;

        if($cacheKey){
            Cache::forget($cacheKey);
        }

    }

    /**
     * Handle the Variation "deleted" event.
     *
     * @param  \App\Models\Variation  $variation
     * @return void
     */
    public function deleted(Variation $variation)
    {
        //
    }

    /**
     * Handle the Variation "restored" event.
     *
     * @param  \App\Models\Variation  $variation
     * @return void
     */
    public function restored(Variation $variation)
    {
        //
    }

    /**
     * Handle the Variation "force deleted" event.
     *
     * @param  \App\Models\Variation  $variation
     * @return void
     */
    public function forceDeleted(Variation $variation)
    {
        //
    }
}
