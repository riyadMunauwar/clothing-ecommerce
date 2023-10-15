<?php 

namespace App\Actions\Cache;

use Illuminate\Support\Facades\Cache;

class RemoveCachedSingleCaurosel {

    public function __construct($cacheKey)
    {
        if( Cache::has(config('cache_keys.home_caurosel_cache_key'))){
            Cache::forget(config('cache_keys.home_caurosel_cache_key'));
        }
    }
}