<?php 

namespace App\Actions\Cache;

use Illuminate\Support\Facades\Cache;


class RemoveCachedSocialLinkList {

    public function __construct()
    {
        if( Cache::has(config('cache_keys.social_link_list_cache_key'))){
            Cache::forget(config('cache_keys.social_link_list_cache_key'));
        }
    }

}