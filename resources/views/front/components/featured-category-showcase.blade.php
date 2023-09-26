<div class="page-content">
    <div class="categories-page">
        <div class="container-fluid">
            <div class="row">

                @foreach($categories as $category)

                        <div class="col-sm-4 col-md-2">
                            <div class="banner banner-cat banner-badge">
                                <a href="#">
                                    <img src="{{ $category->iconUrl('medium') }}" alt="{{ $category->name }}">
                                </a>

                                <a class="banner-link" href="#">
                                    <h3 class="banner-title">{{ $category->name }}</h3><!-- End .banner-title -->
                                    <h4 class="banner-subtitle">{{ $category->count_products }} Products</h4><!-- End .banner-subtitle -->
                                    <span class="banner-link-text">Shop Now</span>
                                </a><!-- End .banner-link -->
                            </div><!-- End .banner -->
                        </div><!-- End .col-sm-8 -->

                @endofreach

            </div><!-- End .row -->
        </div><!-- End .container-fluid -->
    </div><!-- End .categories-page -->
</div><!-- End .page-content -->