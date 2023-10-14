<?php 

namespace App\Actions\Cache;

use Illuminate\Support\Facades\Cache;

class RemoveCachedMenuItems {

    public function __construct()
    {
        if( Cache::has(config('cache_keys.menu_items_cache_key'))){
            Cache::forget(config('cache_keys.menu_items_cache_key'));
        }

        if( Cache::has(config('cache_keys.admin_menu_create_items'))){
            Cache::forget(config('cache_keys.admin_menu_create_items'));
        }
    }
}