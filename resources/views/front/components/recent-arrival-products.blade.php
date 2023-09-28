<section>
    <div class="mb-6"></div>
    <div class="container">
        <div class="heading heading-center mb-6">
            <h2 class="title">Recent Arrivals</h2><!-- End .title -->

            <ul class="nav nav-pills nav-border-anim justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab" aria-controls="top-all-tab" aria-selected="true">All</a>
                </li>
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" id="recent-fur-{{ $category->slug }}-{{$category->id}}-link" data-toggle="tab" href="#recent-fur-{{ $category->slug }}-{{$category->id}}" role="tab" aria-controls="#recent-fur-{{ $category->slug }}-{{$category->id}}" aria-selected="false">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </div><!-- End .heading -->


        <div class="tab-content">


            <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                <div class="products">
                    <div class="row justify-content-center">

                        @foreach($all_products as $product)
                            <div class="col-6 col-md-4 col-lg-3">
                                <div class="product product-11 mt-v3 text-center">
                                    <figure class="product-media">
                                        <a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">
                                            <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}" class="product-image">
                                            <!-- <img src="assets/images/demos/demo-2/products/product-14-2.jpg" alt="Product image" class="product-image-hover"> -->
                                        </a>

                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                        </div>
                                    </figure>

                                    <div class="product-body">
                                        <h3 class="product-title"><a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3>
                                        
                                        <div class="product-price">
                                            BDT {{ $product->sale_price }}
                                        </div>

                                        <!-- Product Variation -->
                                        <!-- <div class="product-nav product-nav-dots">
                                            <a href="#" class="active" style="background: #999999;"><span class="sr-only">Color name</span></a>
                                            <a href="#" style="background: #cc9999;"><span class="sr-only">Color name</span></a>
                                        </div> -->
                                    </div>

                                    <!-- Add To Cart Button Goes Here Below -->
                                    <livewire:front.add-to-cart-button :productId="$product->id" wire:key="$product->uniqueRandomToken()" />

                                </div>
                            </div>
                        @endforeach
                    </div><!-- End .row -->
                </div><!-- End .products -->

                @if($current_page < $last_page)
                    <div class="more-container text-center mt-0 mb-7">
                        <a wire:click.debounce="loadMore" class="btn btn-outline-dark-3 btn-more"><span wire:loading.remove wire:target="loadMore">Load more products</span><span wire:loading wire:target="loadMore">Loading...</span><i class="la la-refresh"></i></a>
                    </div>
                @endif

            </div><!-- .End .tab-pane -->


            @foreach($categories as $category)
                <div class="tab-pane p-0 fade" id="recent-fur-{{ $category->slug }}-{{$category->id}}" role="tabpanel" aria-labelledby="#recent-fur-{{ $category->slug }}-{{$category->id}}">
                    <div class="products">
                        <div class="row justify-content-center">

                            @foreach($category->products as $product)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="product product-11 mt-v3 text-center">
                                        <figure class="product-media">
                                            <a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">
                                                <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}" class="product-image">
                                                <!-- <img src="assets/images/demos/demo-2/products/product-14-2.jpg" alt="Product image" class="product-image-hover"> -->
                                            </a>

                                            <div class="product-action-vertical">
                                                <a href="#" class="btn-product-icon btn-wishlist "><span>add to wishlist</span></a>
                                            </div>
                                        </figure>

                                        <div class="product-body">
                                            <h3 class="product-title"><a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3>
                                            
                                            <div class="product-price">
                                                BDT {{ number_format($product->sale_price) }}
                                            </div>

                                            <!-- Product Variation -->
                                            <!-- <div class="product-nav product-nav-dots">
                                                <a href="#" class="active" style="background: #999999;"><span class="sr-only">Color name</span></a>
                                                <a href="#" style="background: #cc9999;"><span class="sr-only">Color name</span></a>
                                            </div> -->
                                        </div>

                                        <!-- Add To Cart Button -->
                                        <livewire:front.add-to-cart-button :productId="$product->id" wire:key="$product->uniqueRandomToken()" />

                                    </div>
                                </div>
                            @endforeach
                        </div><!-- End .row -->
                    </div><!-- End .products -->

                    <div class="more-container text-center">
                        <a href="{{ route('category', ['category_slug' => $category->slug, 'id' => $category->id]) }}" class="btn btn-outline-darker btn-more"><span>See more products</span><i class="icon-long-arrow-down"></i></a>
                    </div>

                </div><!-- .End .tab-pane -->
            @endforeach

        </div><!-- End .tab-content -->


    </div><!-- End .container -->
</section>