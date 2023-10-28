<section>

    <div class="container">

        <h2 class="title text-center mb-3">Featured</h2><!-- End .title -->

        <div class="row">
            @foreach($products as $product)
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="product product-3">

                        <figure class="product-media">
                            <span class="product-label">Sale</span>
                            <a target="_blank" href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">
                                <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}" class="product-image">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                                <a href="#" class="btn-product-icon btn-quickview" title="Quick view"><span>Quick view</span></a>
                                <a href="#" class="btn-product-icon btn-compare" title="Compare"><span>Compare</span></a>
                            </div>
                        </figure>

                        <div class="product-body">

                            <!-- Add To Cart Button -->
                            <livewire:front.add-to-cart-button :productId="$product->id" wire:key="$product->uniqueRandomToken()" />

                            <div class="product-cat">
                                <a href="{{ route('category', ['category_slug' => $product->categories->first()->slug ?? 'none', 'id' => $product->categories->first()->id ?? 'none' ]) }}">{{ $product->categories->first()->name ?? 'None' }}</a>
                            </div>
                            
                            <h3 target="_blank" class="product-title"><a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3>
                            
                            <div class="product-price">
                                <span class="new-price">BDT {{ number_format($product->sale_price) }}</span>
                                <span class="old-price">Was BDT {{ number_format($product->regular_price) }}</span>
                            </div>

                        </div>

                        <div class="product-footer">

                            <!-- Rating -->
                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 40%;"></div>
                                </div>
                                <span class="ratings-text">( 4 Reviews )</span>
                            </div>
                            <!-- End Rating -->

                            <!-- Variation -->
                            <!-- <div class="product-nav product-nav-thumbs">
                                <a href="#" class="active">
                                    <img src="assets/images/products/elements/product-thumb-1.jpg" alt="product desc">
                                </a>
                                <a href="#">
                                    <img src="assets/images/products/elements/product-thumb-2.jpg" alt="product desc">
                                </a>

                                <a href="#">
                                    <img src="assets/images/products/elements/product-thumb-3.jpg" alt="product desc">
                                </a>
                            </div> -->
                            <!-- End Variation -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

    @if($current_page < $last_page)
        <div class="more-container text-center mt-0 mb-7">
            <a wire:click.debounce="loadMore" class="btn btn-outline-dark-3 btn-more"><span wire:loading.remove wire:target="loadMore">more products</span><span wire:loading wire:target="loadMore">Loading...</span><i class="la la-refresh"></i></a>
        </div>
    @endif
</section>


