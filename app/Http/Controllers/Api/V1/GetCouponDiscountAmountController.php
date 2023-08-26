<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Traits\HttpJsonResponses;

class GetCouponDiscountAmountController extends Controller
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

            $couponCode = $request->code;
            $orderTotalAmount = $request->order_total;

            $discountAmount = $this->getCouponDiscountAmount($couponCode, $orderTotalAmount);

            if($discountAmount) {
                return $this->jsonSuccessResponse([
                    'is_valid' => true,
                    'coupon_code' => $couponCode,
                    'order_total_amount' => (double) $orderTotalAmount,
                    'coupon_discount_amount' => $discountAmount,
                ]);
            }

            return $this->jsonErrorResponse('Invalid coupon code !');

        }catch(\Exception $e){
            return $this->jsonErrorResponse($e->getMessage());
        }
    }


    private function getCouponDiscountAmount($couponCode, $orderTotalAmount)
    {
        $coupon = Coupon::active()->valid()->where('code', $couponCode)->first();

        if( !$coupon) return 0;

        return $coupon->getCouponDiscountAmount($orderTotalAmount);
    }
}
