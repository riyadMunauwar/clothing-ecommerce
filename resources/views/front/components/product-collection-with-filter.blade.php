<section>
    <div class="container">

        <div class="products-container" data-layout="fitRows">

            @foreach($products as $product)
                <div class="product-item furniture sale col-6 col-md-4 col-lg-3">
                    
                    <div class="product product-4">

                        <figure class="product-media">
                            <span class="product-label">Sale</span>
                            <a href="">
                                <img src="{{ $product->thumbnailUrl() }}" alt="{{ $product->name }}" class="product-image">
                            </a>

                            <div class="product-action-vertical">
                                <a href="#" class="btn-product-icon btn-wishlist btn-expandable"><span>add to wishlist</span></a>
                            </div>

                            <div class="product-action">
                                <a  class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                            </div>
                        </figure>

                        <div class="product-body">

                            <h3 class="product-title"><a href="">{{ $product->name }}</a></h3>
                            <div class="product-price">
                                <span class="new-price">BDT {{ $product->sale_price }}</span>
                                <span class="old-price">Was BDT {{ $product->regular_price }}</span>
                            </div>

                            <!-- Product Color Variation -->
                            <!-- <div class="product-nav product-nav-dots">
                                <a href="#" class="active" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                <a href="#" style="background: #cba374;"><span class="sr-only">Color name</span></a>
                            </div> -->

                            <div class="product-action">
                                <a href="#" class="btn-product btn-cart"><span>add to cart</span><i class="icon-long-arrow-right"></i></a>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            @endforeach


        </div><!-- End .products-container -->
    </div><!-- End .container -->

    <div class="more-container text-center mt-0 mb-7">
        <a href="category.html" class="btn btn-outline-dark-3 btn-more"><span>more products</span><i class="la la-refresh"></i></a>
    </div><!-- End .more-container -->
</section>



@push('styles')

    <style>
        .toolbox .nav-filter {
  margin-bottom: 0; }
.nav-filter a {
  font-size: 1.6rem;
  text-transform: capitalize; }
.nav-filter li + li {
  margin-left: .8rem; }

.filter-toggler {
  position: relative;
  display: inline-flex;
  align-items: center;
  color: #333333;
  font-weight: 400;
  font-size: 1.6rem;
  line-height: 33px;
  letter-spacing: -.01em;
  margin-right: 3rem;
  padding-left: 2.4rem; }
  .filter-toggler i {
    margin-right: .8rem; }
  .filter-toggler:before {
    content: '\f131';
    display: block;
    position: absolute;
    left: -.2rem;
    top: 50%;
    margin-top: -1px;
    transform: translateY(-50%);
    font-family: 'molla';
    font-size: 1.9rem;
    line-height: 1; }
  .filter-toggler.active:before {
    content: '\f191'; }
  .filter-toggler:hover, .filter-toggler:focus {
    color: #cc9966; }

.widget-filter-area {
  display: none;
  position: relative; }
  .widget-filter-area .widget {
    padding-top: 2rem;
    border-top: .1rem solid #ebebeb;
    margin-bottom: 0;
    padding-bottom: 3rem; }
  .widget-filter-area .widget-title {
    color: #333;
    font-weight: 300;
    font-size: 1.6rem;
    letter-spacing: -.01em;
    margin-bottom: 2.4rem; }
  .widget-filter-area .custom-control {
    margin-top: .4rem;
    margin-bottom: .4rem; }

.widget-filter-clear {
  display: block;
  color: #cc9966;
  position: absolute;
  right: 0;
  bottom: 100%;
  margin-bottom: 2.4rem;
  font-weight: 300;
  font-size: 1.6rem;
  line-height: 1.5; }

.filter-area-wrapper {
  padding-bottom: 2rem; }

.filter-colors.filter-colors-vertical {
  padding-top: .3rem;
  flex-direction: column;
  align-items: flex-start; }
  .filter-colors.filter-colors-vertical a {
    width: 2rem;
    height: 2rem;
    color: #666;
    margin-bottom: 1.1rem; }
    .filter-colors.filter-colors-vertical a > span {
      display: block;
      position: absolute;
      left: 100%;
      top: 50%;
      transform: translateY(-50%);
      margin-left: 1rem; }
    .filter-colors.filter-colors-vertical a:hover > span, .filter-colors.filter-colors-vertical a:focus > span, .filter-colors.filter-colors-vertical a.selected > span {
      color: #cc9966; }

.filter-price-text {
  margin-bottom: 1.8rem; }

.products-container {
  position: relative;
  margin: 0 -1rem;
  transition: height .4s; }
  .products-container::after {
    display: block;
    clear: both;
    content: ''; }

.product-item {
  float: left;
  margin-bottom: 1rem; }
  .product-item .product {
    margin-bottom: 0; }

.product {
  margin-bottom: 1rem;
  overflow: hidden; }
  .product:hover {
    box-shadow: none; }
  .product .product-body {
    padding-left: 0;
    padding-right: 0; }
  .product .product-price {
    margin-bottom: .3rem; }

.product-title {
  font-size: 1.4rem;
  letter-spacing: 0; }

.product-price {
  font-size: 1.4rem;
  margin-bottom: .5rem; }

.product-nav-dots {
  margin-left: 1px; }

.old-price {
  text-decoration: none; }

.product.product-4 {
  margin-bottom: 0; }
  .product.product-4 .product-action-vertical {
    top: 2rem; }
  .product.product-4 .product-title {
    color: #666;
    margin-bottom: .3rem; }
  .product.product-4 .product-body {
    background-color: transparent; }
    .product.product-4 .product-body .product-action {
      transform: translateY(0);
      bottom: .3rem; }
    /* .product.product-4 .product-body .btn-product {
      display: inline-flex;
      color: #cc9966;
      background-color: transparent !important;
      justify-content: flex-start;
      flex: 0 0 auto;
      padding: .1rem 0; } */
      .product.product-4 .product-body .btn-product i {
        margin-left: .9rem; }
      .product.product-4 .product-body .btn-product span {
        font-size: 1.4rem; }
      /* .product.product-4 .product-body .btn-product:hover, .product.product-4 .product-body .btn-product:focus {
        color: #cc9966;
        background-color: transparent;
        box-shadow: 0 0.1rem 0 0 #cc9966; } */
  /* .product.product-4 .btn-product {
    color: #666;
    padding-top: 1.35rem;
    padding-bottom: 1.35rem; } */
    /* .product.product-4 .btn-product:before {
      display: none; } */
    /* .product.product-4 .btn-product:hover, .product.product-4 .btn-product:focus {
      background-color: #cc9966; } */
  /* .product.product-4 .btn-product:not(:hover):not(:focus) {
    background-color: rgba(255, 255, 255, 0.9); } */
  .product.product-4 .product-nav {
    margin-top: .5rem;
    margin-bottom: .5rem; }

.btn-more {
  letter-spacing: .01em;
  min-width: 170px; }
  .btn-more i {
    font-size: 1.5rem; }
  .btn-more:hover, .btn-more:focus {
    color: #cc9966;
    background-color: #fafafa;
    border-color: #d7d7d7; }
    </style>

@endpush

@push('scirpts')

    <script src="{{ asset('assets/front/js/demos/demo-11.js') }}"></script>

@endpush