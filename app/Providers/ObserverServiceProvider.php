<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Product;
use App\Observers\ProductObserver;
use App\Models\Variation;
use App\Observers\VariationObserver;
use App\Models\Category;
use App\Observers\CategoryObserver;
use App\Models\Brand;
use App\Observers\BrandObserver;
use App\Models\Slide;
use App\Observers\SlideObserver;
use App\Models\Caurosel;
use App\Observers\CauroselObserver;
use App\Models\Banner;
use App\Observers\BannerObserver;
use App\Models\Page;
use App\Observers\PageObserver;
use App\Models\FooterColumn;
use App\Observers\FooterColumnObserver;
use App\Models\FooterColumnAttribute;
use App\Observers\FooterColumnAttributeObserver;
use App\Models\Menu;
use App\Observers\MenuObserver;
use App\Models\SocialLink;
use App\Observers\SocialLinkObserver;
use App\Models\Coupon;
use App\Observers\CouponObserver;


class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Product::observe(ProductObserver::class);
        Variation::observe(VariationObserver::class);
        Brand::observe(BrandObserver::class);
        Category::observe(CategoryObserver::class);
        Banner::observe(BannerObserver::class);
        Caurosel::observe(CauroselObserver::class);
        Slide::observe(SlideObserver::class);
        Page::observe(PageObserver::class);
        FooterColumn::observe(FooterColumnObserver::class);
        FooterColumnAttribute::observe(FooterColumnAttributeObserver::class);
        Menu::observe(MenuObserver::class);
        SocialLink::observe(SocialLinkObserver::class);
        Coupon::observe(CouponObserver::class);
    }

}
