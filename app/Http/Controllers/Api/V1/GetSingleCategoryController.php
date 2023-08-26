<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Traits\HttpJsonResponses;

class GetSingleCategoryController extends Controller
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

            $categoryId = $request->category;
    
            $cacheKey = "categorys:{$categoryId}";
    
            $category = Cache::remember($cacheKey, config('cache.cache_ttl'), function () use($categoryId, $cacheKey){
                return $this->getCategoryByIdAndSaveCacheKey($categoryId, $cacheKey);
            });
    
            if(!$category) return $this->jsonErrorResponse('Product not found !', 404);
            
            return CategoryResource::make($category)->additional($this->jsonSuccessResponseMetaData());
    
        }catch(\Exception $e){
    
            return $this->jsonErrorResponse($e->getMessage());
    
        }
    }


    private function getCategoryByIdAndSaveCacheKey($categoryId, $cacheKey)
    {
        $category = Category::with('media')->published()->find($categoryId);

        if(!$category) return null;

        $category->cache_key = $cacheKey;

        $category->save();

        return $category;
    }

}
