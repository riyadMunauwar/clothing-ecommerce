<section>
    <div class="mb-6"></div>
    <div class="container">
        <div class="heading heading-center mb-3">
            <h2 class="title-lg">Trendy Products</h2><!-- End .title -->

            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="trendy-all-link" data-toggle="tab" href="#trendy-all-tab" role="tab" aria-controls="trendy-all-tab" aria-selected="true">All</a>
                </li>
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" id="trendy-{{ $category->name }}-link" data-toggle="tab" href="#trendy-{{ $category->slug }}" role="tab" aria-controls="trendy-{{ $category->id }}" aria-selected="false">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div><!-- End .heading -->

        <div class="tab-content tab-content-carousel">

            <!-- All Products -->
            <div class="tab-pane p-0 fade show active" id="trendy-all-tab" role="tabpanel" aria-labelledby="trendy-all-link">
                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                    data-owl-options='{
                        "nav": false, 
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
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


                    <!-- Product Item Start -->
                    @foreach($all_products as $product)
                        <div class="product product-11 text-center">
                            <figure class="product-media">
                                <a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">
                                    <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}" class="product-image">
                                    <!-- <img src="assets/images/demos/demo-2/products/product-2-2.jpg" alt="Product image" class="product-image-hover"> -->
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                                </div>
                            </figure>

                            <div class="product-body">

                                <h3 class="product-title"><a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3>
                                
                                <div class="product-price">
                                    BDT {{ $product->sale_price }}
                                </div>

                                <!-- Product Color -->
                                <!-- <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #1f1e18;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #e8e8e8;"><span class="sr-only">Color name</span></a>
                                </div> -->

                            </div>

                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                            </div>

                        </div>
                    @endforeach
                    <!-- Product Item End -->
                </div><!-- End .owl-carousel -->
            </div><!-- .End .tab-pane -->
            <!-- End All Product -->



            <!-- Category Wise Product -->
            @foreach($categories as $category)
                <div class="tab-pane p-0 fade" id="trendy-{{ $category->slug }}" role="tabpanel" aria-labelledby="trendy-{{ $category->id }}">
                    <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                        data-owl-options='{
                            "nav": false, 
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":2
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


                        <!-- Product Item Start -->
                        @foreach($category->products as $product)
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">
                                        <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}" class="product-image">
                                        <!-- <img src="assets/images/demos/demo-2/products/product-2-2.jpg" alt="Product image" class="product-image-hover"> -->
                                    </a>

                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist"><span>add to wishlist</span></a>
                                    </div>
                                </figure>

                                <div class="product-body">

                                    <h3 class="product-title"><a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3>
                                    
                                    <div class="product-price">
                                        {{ $product->sale_price }}
                                    </div>

                                    <!-- Product Color -->
                                    <!-- <div class="product-nav product-nav-dots">
                                        <a href="#" class="active" style="background: #1f1e18;"><span class="sr-only">Color name</span></a>
                                        <a href="#" style="background: #e8e8e8;"><span class="sr-only">Color name</span></a>
                                    </div> -->

                                </div>

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart"><span>add to cart</span></a>
                                </div>
                            </div>
                        @endforeach
                        <!-- Product Item End -->

                    
                    </div><!-- End .owl-carousel -->
                </div><!-- .End .tab-pane -->
            @endforeach
            <!-- End Category Wise Product -->
        </div><!-- End .tab-content -->
    </div><!-- End .container -->
</section>
