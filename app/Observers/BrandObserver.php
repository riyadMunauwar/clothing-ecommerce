<?php

namespace App\Observers;

use App\Models\Brand;
use Illuminate\Support\Facades\Cache;
use App\Actions\Cache\RemoveCachedBrandList;
use App\Actions\Cache\RemoveCachedSingleBrand;

class BrandObserver
{
    /**
     * Handle the Brand "created" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function created(Brand $brand)
    {
        new RemoveCachedBrandList();
    }

    /**
     * Handle the Brand "updated" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function updated(Brand $brand)
    {
        new RemoveCachedBrandList();
        new RemoveCachedSingleBrand($brand->cache_key ?? '');
    }

    /**
     * Handle the Brand "deleted" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function deleted(Brand $brand)
    {
        new RemoveCachedBrandList();
        new RemoveCachedSingleBrand($brand->cache_key ?? '');
    }

    /**
     * Handle the Brand "restored" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function restored(Brand $brand)
    {
        //
    }

    /**
     * Handle the Brand "force deleted" event.
     *
     * @param  \App\Models\Brand  $brand
     * @return void
     */
    public function forceDeleted(Brand $brand)
    {
        //
    }
}
