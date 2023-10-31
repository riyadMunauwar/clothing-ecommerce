<?php

use Illuminate\Support\Facades\Route;
use App\Services\SweetAlertToast;
use App\Facades\SweetAlert;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:admin|editor|manager'
])->group(function () {

    Route::view('/dashboard', 'admin.pages.dashboard')->name('dashboard');
    Route::view('/products/create', 'admin.pages.products.create')->name('products.create');
    Route::view('/products', 'admin.pages.products.list')->name('products.list');
    Route::view('/orders', 'admin.pages.orders.list')->name('orders.list');
    Route::view('/orders/new', 'admin.pages.orders.new-order-list')->name('orders.new-list');
    Route::get('/orders/{order}/show', \App\Http\Controllers\Admin\OrderDetailController::class)->name('orders.show');
    Route::get('/orders/{order}/invoice', \App\Http\Controllers\Admin\GenerateInvoiceController::class)->name('orders.invoice');
    Route::view('/categories/create', 'admin.pages.categories.create')->name('categories.create');
    Route::view('/categories', 'admin.pages.categories.list')->name('categories.list');
    Route::view('/brands/create', 'admin.pages.brands.create')->name('brands.create');
    Route::view('/brands', 'admin.pages.brands.list')->name('brands.list');
    Route::view('/suppliers', 'admin.pages.suppliers.create')->name('suppliers.create');
    Route::view('/banners', 'admin.pages.banners.create')->name('banners.create');
    Route::view('/caurosels', 'admin.pages.caurosels.create')->name('caurosels.create');
    Route::view('/guides', 'admin.pages.guides.create')->name('guides.create');
    Route::view('/menus', 'admin.pages.menus.create')->name('menus.create');
    Route::view('/pages', 'admin.pages.custom-pages.create')->name('pages.create');
    Route::view('/footers', 'admin.pages.footers.create')->name('footers.create');
    Route::view('/admins', 'admin.pages.admins.list')->name('admins.list');
    Route::view('/coupons', 'admin.pages.coupons.create')->name('coupons.create');
    Route::view('/customers', 'admin.pages.customers.list')->name('customers.list');
    Route::view('/socials', 'admin.pages.socials.create')->name('socials.create');
    Route::view('/settings/general', 'admin.pages.settings.create')->name('settings.create');
    Route::view('/header', 'admin.pages.header.create')->name('header.create');

    Route::view('/reports/sales', 'admin.pages.reports.sales-report')->name('reports.sales');
    Route::view('/reports/purchases', 'admin.pages.reports.purchases-report')->name('reports.purchases');
    Route::view('/reports/stocks', 'admin.pages.reports.stocks-report')->name('reports.stocks');
    Route::view('/reports/branded-products', 'admin.pages.reports.branded-products-report')->name('reports.branded-products');
    Route::view('/reports/categorized-products', 'admin.pages.reports.categorized-products-report')->name('reports.categorized-products');
    Route::view('/reports/products-view', 'admin.pages.reports.products-view-report')->name('reports.products-view');
    Route::view('/reports/products-search', 'admin.pages.reports.products-search-report')->name('reports.products-search');
    Route::view('/reports/customer-orders', 'admin.pages.reports.customer-orders-report')->name('reports.customer-orders');


    // Download Invoice Controller
    Route::get('/invoice/download/{orderId}', [\App\Http\Controllers\Admin\GenerateInvoiceController::class, 'downloadInvoice'])->name('invoice.download');
    
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    // User Dashboard
    Route::view('/accounts', 'front.pages.profile.dashboard')->name('user-dashboard');

});


Route::group(['prefix' => 'payment'], function(){

    Route::post('/aamarpay/success', [\App\Http\Controllers\Payment\AamarpayPaymentController::class, 'success'])->name('aamarpay.success');
    Route::post('/aamarpay/failed', [\App\Http\Controllers\Payment\AamarpayPaymentController::class, 'failed'])->name('aamarpay.failed');
    Route::post('/aamarpay/hook/ipn', [\App\Http\Controllers\Payment\AamarpayPaymentController::class, 'ipn'])->name('aamarpay.ipn');
    Route::get('/aamarpay/cancel', [\App\Http\Controllers\Payment\AamarpayPaymentController::class, 'cancel'])->name('aamarpay.cancel');

});


Route::group(['prefix' => 'auth'], function(){

    Route::get('/login/google/redirect', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'googleAuthRedirect'])->name('auth-google-redirect');
    Route::get('/login/google/callback', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'googleAuthCallback'])->name('auth-google-callback');

    Route::get('/login/facebook/redirect', [\App\Http\Controllers\Auth\FacebookAuthController::class, 'facebookAuthRedirect'])->name('auth-facebook-redirect');
    Route::get('/login/facebook/callback', [\App\Http\Controllers\Auth\FacebookAuthController::class, 'facebookAuthCallback'])->name('auth-facebook-callback');

    Route::view('/login', 'front.pages.auth.login')->name('auth-login');
    Route::view('/register', 'front.pages.auth.register')->name('auth-register');

});


// Redirect
// Route::redirect('/login', '/auth/login');
// Route::redirect('/register', '/auth/register');

// Static Pages
Route::get('/results', App\Http\Controllers\Front\SearchController::class)->name('search');
Route::view('/c/{category_slug}/{id}', 'front.pages.archieve')->name('category');
Route::view('/p/{product_slug}/{id}', 'front.pages.single')->name('product');
Route::view('/cart', 'front.pages.cart')->name('cart');
Route::get('/checkout', App\Http\Controllers\Checkout\GetCheckoutPageController::class)->name('checkout');
Route::view('/wishlist', 'front.pages.wishlist')->name('wishlist');



Route::view('/size-guides', 'front.pages.static.size-guides')->name('size-guides');
Route::view('/about-us', 'front.pages.static.about')->name('about-us');
Route::view('/contact-us', 'front.pages.static.contact')->name('contact-us');
Route::view('/terms-of-service', 'front.pages.static.tos')->name('tos');
Route::view('/privacy-policy', 'front.pages.static.privacy')->name('privacy');
Route::view('/billing-and-payment', 'front.pages.static.billing-payment')->name('billing-payment');
Route::view('/shipping-and-delivery', 'front.pages.static.shipping-delivery')->name('shipping-delivery');
Route::view('/return-and-refund-policy', 'front.pages.static.refund-return')->name('return-and-refund');
Route::view('/cancellation-policy', 'front.pages.static.cancellation')->name('cancellation-policy');
Route::view('/faq', 'front.pages.static.faq')->name('faq');


Route::view('/', 'front.pages.home');







