<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="toolbox">
                <div class="toolbox-left">
                    <div class="toolbox-info">
                        Showing <span>{{ $products->count() * $products->currentPage() }} of {{ $products->total() }}</span> Products
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
                                    <a target="_blank" href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">
                                        <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}" class="product-image">
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                        <!-- <a href="#" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                        <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a> -->
                                    </div><!-- End .product-action-vertical -->

                                    <!-- Add to Cart Button -->
                                    <livewire:front.add-to-cart-button :productId="$product->id" wire:key="$product->uniqueRandomToken()" />
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <a href="{{ route('category', ['category_slug' => $product->categories->first()->slug ?? 'none', 'id' => $product->categories->first()->id ?? 'none' ]) }}">{{ $product->categories->first()->name ?? 'None' }}</a>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a target="_blank" href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3><!-- End .product-title -->
                                    
                                    <div class="product-price">
                                        <span class="new-price">{{ config('currency.currency_symbol') }} {{ number_format($product->sale_price) }}</span>
                                        <span class="old-price">Was {{ config('currency.currency_symbol') }} {{ number_format($product->regular_price) }}</span>
                                    </div>

                                    <!-- Product Rating -->
                                    <!-- <div class="ratings-container">
                                        <div class="ratings">
                                            <div class="ratings-val" style="width: 20%;"></div>
                                        </div>
                                        <span class="ratings-text">( 2 Reviews )</span>
                                    </div> -->

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


            <!-- Pagination -->
            {{ $products->links('vendor.pagination.custom') }}


        </div><!-- End .col-lg-12 -->
    </div><!-- End .row -->
</div><!-- End .container -->