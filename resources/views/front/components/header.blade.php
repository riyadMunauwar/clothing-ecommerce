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
                            <li><a href="tel:#"><i class="icon-phone"></i>Call: +8809644776611</a></li>
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
                    <img src="{{ asset('assets/logos/rayat-logo.png') }}" alt="Rayatboutique Logo" width="105" height="25">
                </a>

                <nav class="main-nav">
                    <ul class="menu sf-arrows">


                        @foreach($menus as $menu)

                            @if(!count($menu->children) > 0)

                                @if($menu->category)
                                    <li>
                                        <a href="{{ route('category', ['category_slug' => $menu->category->slug, 'id' => $menu->category->id]) }}">{{ $menu->name }}</a>
                                    </li>
                                @else 
                                    <li>
                                        <a href="{{ $menu->link }}">{{ $menu->name }}</a>
                                    </li>
                                @endif
                            @else
                                <li>
                                    <a style="font-weight: 500; color: #333" class="sf-with-ul">{{ $menu->name }}</a>

                                    <ul>
                                        @foreach($menu->children as $child)

                                            @if(!count($child->children) > 0)

                                                @if($child->category)
                                                    <li><a style="font-weight: 500; color: #333" href="{{ route('category', ['category_slug' => $child->category->slug, 'id' => $child->category->id]) }}">{{ $child->name }}</a></li>
                                                @else
                                                    <li><a style="font-weight: 500; color: #333" href="{{ $child->link }}">{{ $child->name }}</a></li>
                                                @endif

                                            @else
                                                <li>
                                                    <a style="font-weight: 500; color: #333" class="sf-with-ul">{{ $child->name }}</a>

                                                    <ul>
                                                        @foreach($child->children as $grandChild)

                                                            @if($grandChild->category)
                                                                <li><a style="font-weight: 500; color: #333" href="{{ route('category', ['category_slug' => $grandChild->category->slug, 'id' => $grandChild->category->id]) }}">{{ $grandChild->name }}</a></li>
                                                            @else
                                                                <li><a style="font-weight: 500; color: #333" href="{{ $grandChild->link }}">{{ $grandChild->name }}</a></li>
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
                <livewire:front.header-cart-section />



            </div><!-- End .header-right -->
        </div><!-- End .container -->
    </div><!-- End .header-middle -->
</header><!-- End .header -->