<?php 

namespace App\Actions\Cache;

use Illuminate\Support\Facades\Cache;


class RemoveCachedCategoryList {

    public function __construct()
    {
        if( Cache::has(config('cache_keys.category_list_cache_key'))){
            Cache::forget(config('cache_keys.category_list_cache_key'));
        }
    }

}