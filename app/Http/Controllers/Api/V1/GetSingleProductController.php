<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Cache;
use App\Traits\HttpJsonResponses;

class GetSingleProductController extends Controller
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

            $productId = $request->product;
        
            $cacheKey = 'products:' . $productId;
    
            $product = Cache::remember($cacheKey, config('cache.cache_ttl'), function() use($productId, $cacheKey) {
                
                return $this->getProductByIdAndSaveCacheKey($productId, $cacheKey);

            });

            if(!$product) return $this->jsonErrorResponse('Product not found.', 404);

            return ProductResource::make($product)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){

            return $this->jsonErrorResponse($e->getMessage());

        }

    }


    private function getProductByIdAndSaveCacheKey($productId, $cacheKey)
    {
        $product = Product::published()
                            ->with('brand', 'categories')
                            ->with(['variations' => function($query){
                                $query->with('media')->published();
                            }])
                            ->find($productId);
        
        if(!$product) return null;
        
        $product->cache_key = $cacheKey;

        $product->save();

        return $product;

    }

}
