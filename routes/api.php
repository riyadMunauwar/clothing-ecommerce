<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->prefix('v1')->group(function(){
    Route::post('logout', [\App\Http\Controllers\Api\V1\AuthController::class, 'logout']);
});



Route::prefix('v1')->group(function(){

    Route::post('register', [\App\Http\Controllers\Api\V1\AuthController::class, 'register']);
    Route::post('login', [\App\Http\Controllers\Api\V1\AuthController::class, 'login']);

    Route::get('/products',\App\Http\Controllers\Api\V1\GetProductListController::class);
    Route::get('/products/{product}',\App\Http\Controllers\Api\V1\GetSingleProductController::class);
    Route::get('/categories', \App\Http\Controllers\Api\V1\GetCategoryListController::class);
    Route::get('/categories/{category}', \App\Http\Controllers\Api\V1\GetSingleCategoryController::class);
    Route::get('/brands', \App\Http\Controllers\Api\V1\GetBrandListController::class);
    Route::get('/brands/{brand}', \App\Http\Controllers\Api\V1\GetSingleBrandController::class);
    Route::get('/social-links', \App\Http\Controllers\Api\V1\GetSocialLinkListController::class);
    Route::get('/menus', \App\Http\Controllers\Api\V1\GetMenuItemsController::class);
    Route::get('/footers', \App\Http\Controllers\Api\V1\GetFooterItemsController::class);
    Route::get('/banners/{page}', \App\Http\Controllers\Api\V1\GetSingleBannerController::class);
    Route::get('/caurosels/{page}', \App\Http\Controllers\Api\V1\GetSingleCauroselController::class);
    Route::get('/pages/{slug}', \App\Http\Controllers\Api\V1\GetSinglePageController::class);
    Route::get('/coupons/{code}', \App\Http\Controllers\Api\V1\GetSingleCouponController::class);
    Route::get('/coupons/discount/{code}/{order_total}', \App\Http\Controllers\Api\V1\GetCouponDiscountAmountController::class);

});