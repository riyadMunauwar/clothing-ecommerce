<x-front.master-layout title="Archieve">


    <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}')">
        <div class="container-fluid">
            <h1 class="page-title">{{ $query }}<span>Search Page</span></h1>
        </div><!-- End .container-fluid -->
    </div><!-- End .page-header -->

    
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a>Search</a></li>
                <li class="breadcrumb-item"><a>{{ $query }}</a></li>
            </ol>
        </div><!-- End .container-fluid -->
    </nav><!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
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
                                            <livewire:front.add-to-cart-button :productId="$product->id" wire:key="$product->uniqueRandomToken()" />
                                        </figure><!-- End .product-media -->

                                        <div class="product-body">
                                            <div class="product-cat">
                                                <a href="{{ route('category', ['category_slug' => $product->categories->first()->slug ?? 'none', 'id' => $product->categories->first()->id ?? 'none' ]) }}">{{ $product->categories->first()->name ?? 'None' }}</a>
                                            </div><!-- End .product-cat -->
                                            <h3 class="product-title"><a href="{{ route('product', ['product_slug' => $product->slug, 'id' => $product->id]) }}">{{ $product->name }}</a></h3><!-- End .product-title -->
                                            
                                            <div class="product-price">
                                                <span class="new-price">BDT {{ number_format($product->sale_price) }}</span>
                                                <span class="old-price">Was BDT {{ number_format($product->regular_price) }}</span>
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
            </div><!-- End .row -->
        </div><!-- End .container -->
    </div>

</x-front.master-layout>
