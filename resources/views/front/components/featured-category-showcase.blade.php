<div class="page-content">
    <div class="categories-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        @if($featured_category_one)
                        <div class="col-sm-8">
                            <div class="banner banner-cat banner-badge">
                                <a href="#">
                                    <img src="{{ $featured_category_one->iconUrl('medium') }}" alt="{{ $featured_category_one->name }}">
                                </a>

                                <a class="banner-link" href="#">
                                    <h3 class="banner-title">{{ $featured_category_one->name }}</h3><!-- End .banner-title -->
                                    <h4 class="banner-subtitle">{{ $featured_category_one->count_products }} Products</h4><!-- End .banner-subtitle -->
                                    <span class="banner-link-text">Shop Now</span>
                                </a><!-- End .banner-link -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-sm-8 -->
                        @endif

                        @if($featured_category_two)
                            <div class="col-sm-4">
                                <div class="banner banner-cat banner-badge">
                                    <a href="#">
                                        <img src="{{ $featured_category_two->iconUrl('medium') }}" alt="{{ $featured_category_two->name }}">
                                    </a>

                                    <a class="banner-link" href="#">
                                        <h3 class="banner-title">{{ $featured_category_two->name }}</h3><!-- End .banner-title -->
                                        <h4 class="banner-subtitle">{{ $featured_category_two->count_products }} Products</h4><!-- End .banner-subtitle -->
                                        <span class="banner-link-text">Shop Now</span>
                                    </a><!-- End .banner-link -->
                                </div><!-- End .banner -->
                            </div><!-- End .col-sm-4 -->
                        @endif

                        @if($featured_category_three)
                            <div class="col-sm-4">
                                <div class="banner banner-cat banner-badge">
                                    <a href="#">
                                        <img src="{{ $featured_category_three->iconUrl('medium') }}" alt="{{ $featured_category_three->name }}">
                                    </a>

                                    <a class="banner-link" href="#">
                                        <h3 class="banner-title">{{ $featured_category_three->name }}</h3><!-- End .banner-title -->
                                        <h4 class="banner-subtitle">{{ $featured_category_three->count_products }} Products</h4><!-- End .banner-subtitle -->
                                        <span class="banner-link-text">Shop Now</span>
                                    </a><!-- End .banner-link -->
                                </div><!-- End .banner -->
                            </div><!-- End .col-sm-4 -->
                        @endif

                        @if($featured_category_four)
                            <div class="col-sm-8">
                                <div class="banner banner-cat banner-badge">
                                    <a href="#">
                                        <img src="{{ $featured_category_four->iconUrl('medium') }}" alt="{{ $featured_category_four->name }}">
                                    </a>

                                    <a class="banner-link" href="#">
                                        <h3 class="banner-title">{{ $featured_category_four->name }}</h3><!-- End .banner-title -->
                                        <h4 class="banner-subtitle">{{ $featured_category_four->count_products }} Products</h4><!-- End .banner-subtitle -->
                                        <span class="banner-link-text">Shop Now</span>
                                    </a><!-- End .banner-link -->
                                </div><!-- End .banner -->
                            </div><!-- End .col-sm-4 -->
                        @endif

                    </div><!-- End .row -->
                </div><!-- End .col-lg-6 -->

                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="banner banner-cat banner-badge">
                                <a href="#">
                                    <img src="{{ asset('assets/images/category/fullwidth-page/banner-5.jpg') }}" alt="Banner">
                                </a>

                                <a class="banner-link" href="#">
                                    <h3 class="banner-title">Dresses</h3><!-- End .banner-title -->
                                    <h4 class="banner-subtitle">3 Products</h4><!-- End .banner-subtitle -->
                                    <span class="banner-link-text">Shop Now</span>
                                </a><!-- End .banner-link -->
                            </div><!-- End .banner -->

                            <div class="banner banner-cat banner-badge">
                                <a href="#">
                                    <img src="{{ asset('assets/images/category/fullwidth-page/banner-6.jpg') }}" alt="Banner">
                                </a>

                                <a class="banner-link" href="#">
                                    <h3 class="banner-title">Shoes</h3><!-- End .banner-title -->
                                    <h4 class="banner-subtitle">2 Products</h4><!-- End .banner-subtitle -->
                                    <span class="banner-link-text">Shop Now</span>
                                </a><!-- End .banner-link -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-sm-8 -->

                        <div class="col-sm-4">
                            <div class="banner banner-cat banner-badge">
                                <a href="#">
                                    <img src="{{ asset('assets/images/category/fullwidth-page/banner-7.jpg') }}" alt="Banner">
                                </a>

                                <a class="banner-link" href="#">
                                    <h3 class="banner-title">T-shirts</h3><!-- End .banner-title -->
                                    <h4 class="banner-subtitle">0 Products</h4><!-- End .banner-subtitle -->
                                    <span class="banner-link-text">Shop Now</span>
                                </a><!-- End .banner-link -->
                            </div><!-- End .banner -->

                            <div class="banner banner-cat banner-badge">
                                <a href="#">
                                    <img src="{{ asset('assets/images/category/fullwidth-page/banner-8.jpg') }}" alt="Banner">
                                </a>

                                <a class="banner-link" href="#">
                                    <h3 class="banner-title">Jumpers</h3><!-- End .banner-title -->
                                    <h4 class="banner-subtitle">1 Product</h4><!-- End .banner-subtitle -->
                                    <span class="banner-link-text">Shop Now</span>
                                </a><!-- End .banner-link -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-sm-4 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .categories-page -->
</div><!-- End .page-content -->