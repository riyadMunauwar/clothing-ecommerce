<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryCollectionResource;
use App\Models\Category;
use Illuminate\Support\Facades\Cache; 
use App\Traits\HttpJsonResponses;

class GetCategoryListController extends Controller
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

            $cacheKey = config('cache_keys.category_list_cache_key');

            $categories = Cache::remember( $cacheKey, config('cache.cache_ttl'), function(){
                return Category::with('children', 'media')->published()->whereNull('parent_id')->get();
            });

            return CategoryCollectionResource::collection($categories)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){

            return $this->jsonErrorResponse($e->getMessage());

        }

    }
}
