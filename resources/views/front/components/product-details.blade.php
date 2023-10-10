<div class="container">
    <div class="row">
        <div class="col-lg-9">
            <div class="product-details-top">
                <div class="row">
                    <div class="col-md-6">
                        <div class="product-gallery">
                            <figure class="product-main-image">
                                <span class="product-label label-top">Top</span>
                                <img id="product-zoom" src="{{ $product->thumbnailUrl('medium') }}" data-zoom-image="{{ $product->thumbnailUrl('medium') }}" alt="{{ $product->name }}">

                                <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                    <i class="icon-arrows"></i>
                                </a>
                            </figure><!-- End .product-main-image -->

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                <a class="product-gallery-item active" href="#" data-image="{{ $product->thumbnailUrl('medium') }}" data-zoom-image="{{ $product->thumbnailUrl('medium') }}">
                                    <img src="{{ $product->thumbnailUrl('thumb') }}" alt="{{ $product->name }}">
                                </a>

                                @foreach($product->galleryImage() as $image)
                                    <a class="product-gallery-item" href="#" data-image="{{ $image['medium'] }}" data-zoom-image="{{ $image['medium'] }}">
                                        <img src="{{ $image['thumb'] }}" alt="product cross">
                                    </a>
                                @endforeach

                            </div><!-- End .product-image-gallery -->
                        </div><!-- End .product-gallery -->
                    </div><!-- End .col-md-6 -->

                    <div class="col-md-6">
                        <div class="product-details product-details-sidebar">
                            <h1 class="product-title">{{ $product->name }}</h1><!-- End .product-title -->

                            <!-- Ratings -->
                            <!-- <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%;"></div>
                                </div>
                                <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                            </div> -->

                            <div class="product-price">
                                {{ number_format($sale_price) }}
                                <del style="color: #333" class="ml-3 text-2xl">{{ number_format($regular_price) }}</del>
                            </div><!-- End .product-price -->

                            <div class="product-content">
                                {!! $product->short_description !!}
                            </div><!-- End .product-content -->

                            <!-- Color -->
                            <!-- <div class="details-filter-row details-row-size">
                                <label>Color:</label>

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #efe7db;"><span class="sr-only">Color name</span></a>
                                </div>
                            </div> -->

                            @foreach($variation_options as $attribute => $values)
                                <div class="details-filter-row details-row-size">
                                    <label for="size">{{$attribute}}:</label>
                                    <div class="select-custom">
                                        <select name="size" id="size" class="form-control">
                                            <option value="#" selected="selected">Select a {{ $attribute }}</option>
                                            @foreach($values as $value)
                                                <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div><!-- End .select-custom -->

                                    <a href="#" class="size-guide"><i class="icon-th-list"></i>{{ $attribute }} guide</a>
                                </div><!-- End .details-filter-row -->
                            @endforeach
                            <div class="product-details-action">
                                <div class="details-action-col">
                                    <label for="qty">Qty:</label>
                                    <div class="product-details-quantity">
                                        <input wire:model.debounce="qty" type="number" id="qty" class="form-control" value="1" min="1" max="10000" step="1" data-decimals="0" required>
                                    </div><!-- End .product-details-quantity -->

                                    <button wire:click.debounce="AddToCart" class="btn-product btn-cart"><span>add to cart</span></button>
                                </div><!-- End .details-action-col -->


                                <!-- Compare & Wishlist -->
                                <!-- <div class="details-action-wrapper">
                                    <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                    <a href="#" class="btn-product btn-compare" title="Compare"><span>Add to Compare</span></a>
                                </div> -->


                            </div><!-- End .product-details-action -->

                            <div class="product-details-footer details-footer-col">
                                <div class="product-cat">
                                    <span>Category:</span>
                                    @foreach($product->categories as $category)
                                        @if($loop->last)
                                            <a href="#">{{ $category->name }}</a>
                                        @else 
                                            <a href="#">{{ $category->name }},</a>
                                        @endif
                                    @endforeach
                                </div>

                                    <!-- Share button -->
                                <!-- <div class="social-icons social-icons-sm">
                                    <span class="social-label">Share:</span>
                                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                                </div> -->

                            </div><!-- End .product-details-footer -->
                        </div><!-- End .product-details -->
                    </div><!-- End .col-md-6 -->
                </div><!-- End .row -->
            </div><!-- End .product-details-top -->

            <div class="product-details-tab">
                <ul class="nav nav-pills justify-content-center" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                        <div class="product-desc-content">
                            <h3>Product Information</h3>
                            {!! $product->description !!}
                        </div>
                    </div>
                    
                    
                
                    <!-- Additional Information -->
                    <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                        <div class="product-desc-content">
                            <h3>Information</h3>
                            {!! $product->short_description !!}
                        </div>
                    </div>

                    <!-- Return & Shipping Tab -->
                    <!-- <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                        <div class="product-desc-content">
                            <h3>Delivery & returns</h3>
                            <p>We deliver to over 100 countries around the world. For full details of the delivery options we offer, please view our <a href="#">Delivery information</a><br>
                            We hope you’ll love every purchase, but if you ever need to return an item you can do so within a month of receipt. For full details of how to make a return, please view our <a href="#">Returns information</a></p>
                        </div>
                    </div> -->

                    <!-- Review table -->
                    <!-- <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                        <div class="reviews">
                            <h3>Reviews (2)</h3>
                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">Samanta J.</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 80%;"></div>
                                            </div>
                                        </div>
                                        <span class="review-date">6 days ago</span>
                                    </div>
                                    <div class="col">
                                        <h4>Good, perfect size</h4>

                                        <div class="review-content">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                        </div>

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="review">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">John Doe</a></h4>
                                        <div class="ratings-container">
                                            <div class="ratings">
                                                <div class="ratings-val" style="width: 100%;"></div>
                                            </div>
                                        </div>
                                        <span class="review-date">5 days ago</span>
                                    </div>
                                    <div class="col">
                                        <h4>Very good</h4>

                                        <div class="review-content">
                                            <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                        </div>

                                        <div class="review-action">
                                            <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                            <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->


                </div><!-- End .tab-content -->
            </div><!-- End .product-details-tab -->

            <h2 class="title text-center mb-4">You May Also Like</h2><!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                data-owl-options='{
                    "nav": false, 
                    "dots": true,
                    "margin": 20,
                    "loop": false,
                    "responsive": {
                        "0": {
                            "items":1
                        },
                        "480": {
                            "items":2
                        },
                        "768": {
                            "items":3
                        },
                        "992": {
                            "items":4
                        },
                        "1200": {
                            "items":4,
                            "nav": true,
                            "dots": false
                        }
                    }
                }'>

                @foreach($recommendation_products as $product)
                    <div class="product product-7 text-center">
                        <figure class="product-media">
                            <span class="product-label label-new">New</span>
                            <a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">
                                <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}" class="product-image">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                <a href="" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            </div><!-- End .product-action-vertical -->

                            <div class="product-action">
                                <button  class="btn-product btn-cart"><span>add to cart</span></button>
                            </div><!-- End .product-action -->
                        </figure><!-- End .product-media -->

                        <div class="product-body">

                            <div class="product-cat">
                                <a href="{{ route('category', ['category_slug' => $product->categories->first()->slug ?? 'none', 'id' => $product->categories->first()->id ?? 'none' ]) }}">{{ $product->categories->first()->name ?? 'None' }}</a>
                            </div>

                            <h3 class="product-title"><a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3>
                            
                            <div class="product-price">
                                BDT {{ number_format($product->sale_price) }}
                            </div><!-- End .product-price -->


                            <!-- Ratings -->
                            <!-- <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 20%;"></div>
                                </div>
                                <span class="ratings-text">( 2 Reviews )</span>
                            </div> -->

                            <!-- Color -->
                            <!-- <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #cc9966;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #7fc5ed;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #e8c97a;"><span class="sr-only">Color name</span></a>
                            </div> -->

                        </div><!-- End .product-body -->
                    </div><!-- End .product -->
                @endforeach

                
            </div><!-- End .owl-carousel -->
        </div><!-- End .col-lg-9 -->

        <aside class="col-lg-3">
            <div class="sidebar sidebar-product">
                <div class="widget widget-products">
                    <h4 class="widget-title">Related Product</h4><!-- End .widget-title -->

                    <div class="products">

                        @foreach($related_products as $product)
                            <div class="product product-sm">
                                <figure class="product-media">
                                    <a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">
                                        <img src="{{ $product->thumbnailUrl('thumb') }}" alt="{{ $product->name }}" class="product-image">
                                    </a>
                                </figure>

                                <div class="product-body">
                                    <h5 class="product-title"><a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h5><!-- End .product-title -->
                                    <div class="product-price">
                                        <span class="new-price">BDT {{ number_format($product->sale_price) }}</span>
                                        <span class="old-price"><del>was BDT {{ number_format($product->regular_price) }}</del></span>
                                    </div><!-- End .product-price -->
                                </div><!-- End .product-body -->
                            </div><!-- End .product product-sm -->
                        @endforeach
                    </div><!-- End .products -->

                    <a href="category.html" class="btn btn-outline-dark-3"><span>View More Products</span><i class="icon-long-arrow-right"></i></a>
                </div><!-- End .widget widget-products -->

                <!-- Add box -->
                <!-- <div class="widget widget-banner-sidebar">
                    <div class="banner-sidebar-title">ad box 280 x 280</div>
                    
                    <div class="banner-sidebar banner-overlay">
                        <a href="#">
                            <img src="assets/images/blog/sidebar/banner.jpg" alt="banner">
                        </a>
                    </div>
                </div> -->


            </div><!-- End .sidebar sidebar-product -->
        </aside><!-- End .col-lg-3 -->
    </div><!-- End .row -->

</div><!-- End .container -->
