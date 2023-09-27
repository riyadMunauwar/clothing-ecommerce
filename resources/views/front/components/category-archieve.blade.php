<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="toolbox">
                <div class="toolbox-left">
                    <div class="toolbox-info">
                        Showing <span>9 of 56</span> Products
                    </div><!-- End .toolbox-info -->
                </div><!-- End .toolbox-left -->

                <div class="toolbox-right">
                    <div class="toolbox-sort">
                        <label for="sortby">Sort by:</label>
                        <div class="select-custom">
                            <select name="sortby" id="sortby" class="form-control">
                                <option value="popularity" selected="selected">Most Popular</option>
                                <option value="rating">Most Rated</option>
                                <option value="date">Date</option>
                            </select>
                        </div>
                    </div><!-- End .toolbox-sort -->
                </div><!-- End .toolbox-right -->
            </div><!-- End .toolbox -->

            <div class="products mb-3">
                <div class="row justify-content-center">

                    @foreach($products as $product)
                        <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                            <div class="product product-7 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-new">New</span>
                                    <a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">
                                        <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                        <!-- <a href="#" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a> -->
                                    </div><!-- End .product-action-vertical -->

                                    <!-- Add to Cart Button -->
                                    <livewire:front.add-to-cart-button :productId="$product->id" wire:key="$product->id" />
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="{{ route('category', ['category_slug' => $product->categories->first()->slug ?? 'none', 'id' => $product->categories->first()->id ?? 'none' ]) }}">{{ $product->categories->first()->name ?? 'None' }}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3><!-- End .product-title -->
                                    
                                    <div class="product-price">
                                        <span class="new-price">BDT {{ $product->sale_price }}</span>
                                        <span class="old-price">Was BDT {{ $product->regular_price }}</span>
                                    </div>

                                    <!-- Product Rating -->
                                    <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 20%;"></div><!-- End .ratings-val -->
                                        </div><!-- End .ratings -->
                                        <span class="ratings-text">( 2 Reviews )</span>
                                    </div>

                                    <!-- Variation Section -->
                                    <!-- <div class="product-nav product-nav-thumbs">
                                        <a href="#" class="active">
                                            <img src="assets/images/products/product-4-thumb.jpg" alt="product desc">
                                        </a>
                                        <a href="#">
                                            <img src="assets/images/products/product-4-2-thumb.jpg" alt="product desc">
                                        </a>

                                        <a href="#">
                                            <img src="assets/images/products/product-4-3-thumb.jpg" alt="product desc">
                                        </a>
                                    </div> -->

                                </div><!-- End .product-body -->
                            </div><!-- End .product -->
                        </div><!-- End .col-sm-6 col-lg-4 col-xl-3 -->
                    @endforeach

                </div><!-- End .row -->
            </div><!-- End .products -->


            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link page-link-prev" href="#" aria-label="Previous" tabindex="-1" aria-disabled="true">
                            <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span>Prev
                        </a>
                    </li>
                    <li class="page-item active" aria-current="page"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item-total">of 6</li>
                    <li class="page-item">
                        <a class="page-link page-link-next" href="#" aria-label="Next">
                            Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div><!-- End .col-lg-9 -->
        <aside class="col-lg-3 order-lg-first">
            <div class="sidebar sidebar-shop">
                <div class="widget widget-clean">
                    <label>Filters:</label>
                    <a href="#" class="sidebar-filter-clear">Clean All</a>
                </div><!-- End .widget widget-clean -->


                <!-- Category Widget -->
                @if(count($categories) > 0)
                    <div class="widget">
                        <h3 class="widget-title">
                            <a>
                                Category
                            </a>
                        </h3><!-- End .widget-title -->

                        <div>
                            <div class="widget-body">
                                <div class="filter-items filter-items-count">
                                    @foreach($categories as $category)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="radio" wire:model.debounce="select_category_id" value="{{ $category->id }}" name="select_category" class="custom-control-input" id="cat-{{ $category->id }}">
                                                <label class="custom-control-label" for="cat-{{ $category->id }}">{{ $category->name }}</label>
                                            </div><!-- End .custom-checkbox -->
                                            <span class="item-count">{{ $category->products_count }}</span>
                                        </div><!-- End .filter-item -->
                                    @endforeach
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->
                @endif


                <!-- Sizes Widget -->

                @if(count($sizes) > 0)
                    <div class="widget">
                        <h3 class="widget-title">
                            <a>
                                Size
                            </a>
                        </h3><!-- End .widget-title -->

                        <div>
                            <div class="widget-body">
                                <div class="filter-items">
                                    @foreach($sizes as $size)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="size-{{ $size }}">
                                                <label class="custom-control-label" for="size-{{ $size }}">{{ $size }}</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    @endforeach
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->
                @endif

                @if(count($colors) > 0)
                    <div class="widget">
                        <h3 class="widget-title">
                            <a>
                                Color
                            </a>
                        </h3><!-- End .widget-title -->

                        <div>
                            <div class="widget-body">
                                <div class="filter-items">
                                    @foreach($colors as $color)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="color-{{ $color }}">
                                                <label class="custom-control-label" for="color-{{ $color }}">{{ $color }}</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    @endforeach
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->
                @endif




                <!-- Brands Widget -->
                @if(count($brands) > 0)
                    <div class="widget">
                        <h3 class="widget-title">
                            <a>
                                Brand
                            </a>
                        </h3><!-- End .widget-title -->

                        <div>
                            <div class="widget-body">
                                <div class="filter-items">
                                    @foreach($brands as $brand)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-{{ $brand->id }}">
                                                <label class="custom-control-label" for="brand-{{ $brand->id }}">{{ $brand->name }}</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    @endforeach
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->
                @endif

                <!-- Brands Widget -->
                @if(count($price_ranges) > 0)
                    <div class="widget">
                        <h3 class="widget-title">
                            <a>
                                Price
                            </a>
                        </h3><!-- End .widget-title -->

                        <div>
                            <div class="widget-body">
                                <div class="filter-items">
                                    @foreach($price_ranges as $_price)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="brand-{{ $_price }}">
                                                <label class="custom-control-label" for="brand-{{ $_price }}">{{ $_price}}</label>
                                            </div><!-- End .custom-checkbox -->
                                        </div><!-- End .filter-item -->
                                    @endforeach
                                </div><!-- End .filter-items -->
                            </div><!-- End .widget-body -->
                        </div><!-- End .collapse -->
                    </div><!-- End .widget -->
                @endif


            </div><!-- End .sidebar sidebar-shop -->
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->
</div><!-- End .container -->