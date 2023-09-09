<header class="header">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <!-- <div class="header-dropdown">
                    <a href="#">Usd</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">Eur</a></li>
                            <li><a href="#">Usd</a></li>
                        </ul>
                    </div>
                </div> -->

                <div class="header-dropdown">
                    <a href="#">Wholesale/Custom Orders</a>
                    <div class="header-menu">
                        <ul>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">Register</a></li>
                        </ul>
                    </div>
                </div>
            </div><!-- End .header-left -->

            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li><a href="tel:#"><i class="icon-phone"></i>Call: +0123 456 789</a></li>
                            <li><a href="{{ route('wishlist') }}"><i class="icon-heart-o"></i>Wishlist <span>(3)</span></a></li>
                            <li><a href="{{ route('about-us') }}">About Us</a></li>
                            <li><a href="{{ route('contact-us') }}">Contact Us</a></li>
                            @auth
                                <li><a href="{{ route('user-dashboard') }}">Account</a></li>
                            @endauth

                            @guest
                                <li><a href="{{ route('login') }}"><i class="icon-user"></i>Login</a></li>
                                <li><a href="{{ route('register') }}"><i class="icon-user"></i>Register</a></li>
                            @endguest
                        </ul>
                    </li>
                </ul><!-- End .top-menu -->
            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-top -->

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>

                <a href="/" class="logo">
                    <img src="{{ asset('assets/images/rayatboutiqe-logo.png') }}" alt="Rayatboutique Logo" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">

                        @php 
                        
                            $menus = \App\Models\Menu::published()->where('parent_id', null)->orderBy('order')->get();

                        @endphp

                        @foreach($menus as $menu)

                            @php 
                            
                                $children = \App\Models\Menu::published()->where('parent_id', $menu->id)->orderBy('order')->get();

                            @endphp

                            @if(!count($children) > 0)
                                @if($menu->category)
                                    <li>
                                        <a href="#">{{ $menu->name }}</a>
                                    </li>
                                @else 
                                    <li>
                                        <a href="{{ $menu->link }}">{{ $menu->name }}</a>
                                    </li>
                                @endif
                            @else
                                <li>
                                    <a href="#" class="sf-with-ul">{{ $menu->name }}</a>

                                    <ul>
                                        @foreach($children as $child)

                                            @php 

                                                $grandChildren = \App\Models\Menu::published()->where('parent_id', $child->id)->orderBy('order')->get();

                                            @endphp

                                            @if(!count($grandChildren) > 0)

                                                @if($child->category)
                                                    <li><a href="#">{{ $child->name }}</a></li>
                                                @else
                                                    <li><a href="{{ $child->link }}">{{ $child->name }}</a></li>
                                                @endif

                                            @else
                                                <li>
                                                    <a href="#" class="sf-with-ul">{{ $child->name }}</a>

                                                    <ul>
                                                        @foreach($grandChildren as $grandChild)

                                                            @if($grandChild->category)
                                                                <li><a href="#">{{ $grandChild->name }}</a></li>
                                                            @else
                                                                <li><a href="{{ $grandChild->link }}">{{ $grandChild->name }}</a></li>
                                                            @endif

                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                    </ul><!-- End .menu -->
                </nav><!-- End .main-nav -->
            </div><!-- End .header-left -->

            <div class="header-right">

                <!-- Search -->
                <div class="header-search">
                    <a href="#" class="search-toggle" role="button" title="Search"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search in..." required>
                        </div><!-- End .header-search-wrapper -->
                    </form>
                </div><!-- End .header-search -->


                <!-- Compare -->
                <!-- <div class="dropdown compare-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Compare Products" aria-label="Compare Products">
                        <i class="icon-random"></i>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="compare-products">
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                <h4 class="compare-product-title"><a href="product.html">Blue Night Dress</a></h4>
                            </li>
                            <li class="compare-product">
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                <h4 class="compare-product-title"><a href="product.html">White Long Skirt</a></h4>
                            </li>
                        </ul>

                        <div class="compare-actions">
                            <a href="#" class="action-link">Clear All</a>
                            <a href="#" class="btn btn-outline-primary-2"><span>Compare</span><i class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div> -->


                <!-- Header Cart -->
                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="icon-shopping-cart"></i>
                        <span class="cart-count">2</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-cart-products">
                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="product.html">Beige knitted elastic runner shoes</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span>
                                        x $84.00
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="assets/images/products/cart/product-1.jpg" alt="product">
                                    </a>
                                </figure>
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                            </div><!-- End .product -->

                            <div class="product">
                                <div class="product-cart-details">
                                    <h4 class="product-title">
                                        <a href="product.html">Blue utility pinafore denim dress</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <span class="cart-product-qty">1</span>
                                        x $76.00
                                    </span>
                                </div><!-- End .product-cart-details -->

                                <figure class="product-image-container">
                                    <a href="product.html" class="product-image">
                                        <img src="assets/images/products/cart/product-2.jpg" alt="product">
                                    </a>
                                </figure>
                                <a href="#" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                            </div><!-- End .product -->
                        </div><!-- End .cart-product -->

                        <div class="dropdown-cart-total">
                            <span>Total</span>

                            <span class="cart-total-price">$160.00</span>
                        </div><!-- End .dropdown-cart-total -->

                        <div class="dropdown-cart-action">
                            <a href="{{ route('cart') }}" class="btn btn-primary">View Cart</a>
                            <a href="{{ route('checkout') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .dropdown-cart-total -->

                    </div><!-- End .dropdown-menu -->
                </div><!-- End .cart-dropdown -->



            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->