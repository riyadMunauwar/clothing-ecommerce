<?php 

namespace App\Actions\Cache;

use Illuminate\Support\Facades\Cache;

class RemoveCachedFooterItems {

    public function __construct()
    {
        if( Cache::has(config('cache_keys.footer_items_cache_key'))){
            Cache::forget(config('cache_keys.footer_items_cache_key'));
        }
    }
}