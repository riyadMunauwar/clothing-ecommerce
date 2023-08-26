<?php 

namespace App\Actions\Cache;

use Illuminate\Support\Facades\Cache;


class RemoveCachedBrandList {

    public function __construct()
    {
        if( Cache::has(config('cache_keys.brand_list_cache_key'))){
            Cache::forget(config('cache_keys.brand_list_cache_key'));
        }

        if( Cache::has(config('cache_keys.featured_brand_list_cache_key'))){
            Cache::forget(config('cache_keys.featured_brand_list_cache_key'));
        }
    }

}