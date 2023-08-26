<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Http\Resources\BannerResource;
use Illuminate\Support\Facades\Cache;
use App\Traits\HttpJsonResponses;

class GetSingleBannerController extends Controller
{

    use HttpJsonResponses;

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {

            $showInPage = $request->page;

            $cacheKey = "banner:{$showInPage}";

            $banner = $this->getBanner($showInPage, $cacheKey);

            if(!$banner) return $this->jsonErrorResponse('Banner not found !', 404);

            return BannerResource::make($banner)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){
            return $this->jsonErrorResponse($e->getMessage());
        }
    }


    private function getBanner($showInPage, $cacheKey)
    {
        return Cache::remember($cacheKey, config('cache.cache_ttl'), function() use($showInPage, $cacheKey){
            return $this->getBannerBySlugAndSaveCacheKey($showInPage, $cacheKey);
        });
    }


    private function getBannerBySlugAndSaveCacheKey($showInPage, $cacheKey)
    {
        $banner = Banner::published()->where('show_in_page', $showInPage)->first();

        if(!$banner) return null;

        $banner->cache_key = $cacheKey;

        $banner->save();

        return $banner;
    }
}
