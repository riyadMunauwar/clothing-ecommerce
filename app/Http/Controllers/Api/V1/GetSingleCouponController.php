<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Http\Resources\CouponResource;
use Illuminate\Support\Facades\Cache;
use App\Traits\HttpJsonResponses;

class GetSingleCouponController extends Controller
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

            $couponCode = $request->code;

            $cacheKey = "coupon:{$couponCode}";

            $coupon = $this->getCoupon($couponCode, $cacheKey);

            if(!$coupon) return $this->jsonErrorResponse('Coupon not found !', 404);

            return CouponResource::make($coupon)->additional($this->jsonSuccessResponseMetaData());

        }catch(\Exception $e){
            return $this->jsonErrorResponse($e->getMessage());
        }
    }


    private function getCoupon($couponCode, $cacheKey)
    {
        return Cache::remember($cacheKey, config('cache.cache_ttl'), function() use($couponCode, $cacheKey){
            return $this->getCouponBySlugAndSaveCacheKey($couponCode, $cacheKey);
        });
    }


    private function getCouponBySlugAndSaveCacheKey($couponCode, $cacheKey)
    {
        $coupon = Coupon::active()->where('code', $couponCode)->first();

        if(!$coupon) return null;

        $coupon->cache_key = $cacheKey;

        $coupon->save();

        return $coupon;
    }
}
