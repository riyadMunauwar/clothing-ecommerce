<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Http\Resources\BrandResource;
use App\Traits\HttpJsonResponses;



class GetSingleBrandController extends Controller
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

            $brandId = $request->brand;

            $cacheKey = "brands:{$brandId}";

            $brand = Cache::remember($cacheKey, config('cache.cache_ttl'), function () use($brandId, $cacheKey){
                return $this->getBrandByIdAndSaveCacheKey($brandId, $cacheKey);
            });

            if(!$brand) return $this->jsonErrorResponse('Product not found !', 404);
            
            return BrandResource::make($brand)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){

            return $this->jsonErrorResponse($e->getMessage());

        }
    }


    private function getBrandByIdAndSaveCacheKey($brandId, $cacheKey)
    {
        $brand = Brand::with('media')->published()->find($brandId);

        if(!$brand) return null;

        $brand->cache_key = $cacheKey;

        $brand->save();

        return $brand;
    }

}
