<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Http\Resources\PageResource;
use Illuminate\Support\Facades\Cache;
use App\Traits\HttpJsonResponses;

class GetSinglePageController extends Controller
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

            $pageSlug = $request->slug;

            $cacheKey = "page:{$pageSlug}";

            $page = $this->getPage($pageSlug, $cacheKey);

            if(!$page) return $this->jsonErrorResponse('Page not found !', 404);

            return PageResource::make($page)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){
            return $this->jsonErrorResponse($e->getMessage());
        }
    }


    private function getPage($pageSlug, $cacheKey)
    {
        return Cache::remember($cacheKey, config('cache.cache_ttl'), function() use($pageSlug, $cacheKey){
            return $this->getPageBySlugAndSaveCacheKey($pageSlug, $cacheKey);
        });
    }


    private function getPageBySlugAndSaveCacheKey($pageSlug, $cacheKey)
    {
        $page = Page::published()->where('slug', $pageSlug)->first();

        if(!$page) return null;

        $page->cache_key = $cacheKey;

        $page->save();

        return $page;
    }

}