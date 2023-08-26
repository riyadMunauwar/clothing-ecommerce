<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Resources\BrandCollectionResource;
use Illuminate\Support\Facades\Cache;
use App\Traits\HttpJsonResponses;


class GetBrandListController extends Controller
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
        try{

            $featured = $request->query('featured', false);

            $cacheKey = $featured ? config('cache_keys.featured_brand_list_cache_key') : config('cache_keys.brand_list_cache_key');

            $brands = Cache::remember($cacheKey, config('cache.cache_ttl'), function() use($featured){
                return $this->getBrandList($featured);
            });
            
            return BrandCollectionResource::collection($brands)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){

            return $this->jsonErrorResponse($e->getMessage());

        }

    }


    public function getBrandList($featured)
    {
        return Brand::with('media')
                    ->published()
                    ->when($featured, function($query) {
                        $query->where('is_featured', true);
                    })
                    ->get();
    }

}
