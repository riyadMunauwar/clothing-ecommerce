<?php 

namespace App\Actions\Cache;

use Illuminate\Support\Facades\Cache;

class RemoveCachedSingleCoupon{

    public function __construct($cacheKey)
    {
        if( Cache::has($cacheKey)){
            Cache::forget($cacheKey);
        }
    }
}