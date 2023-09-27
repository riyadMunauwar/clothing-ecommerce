<div class="dropdown cart-dropdown">
    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
        <i class="icon-shopping-cart"></i>
        <span class="cart-count">{{ $cart_items_count }}</span>
    </a>

    <div class="dropdown-menu dropdown-menu-right">
        <div class="dropdown-cart-products">

            @forelse($cart_items as $item)
                <div class="product">
                    <div class="product-cart-details">
                        <h4 class="product-title">
                            <a href="">{{ $item->name }}</a>
                        </h4>

                        <span class="cart-product-info">
                            <span class="cart-product-qty">{{ $item->qty }}</span>
                            x BDT {{ $item->price }}
                        </span>
                    </div><!-- End .product-cart-details -->

                    <figure class="product-image-container">
                        <a href="" class="product-image">
                            <img src="{{ $item->options->thumbnail }}" alt="{{ $item->name }}">
                        </a>
                    </figure>
                    <button wire:click.debounce="prearedCartItemsData({{ $item->id }})" class="btn-remove" title="Remove Product"><i class="icon-close"></i></button>
                </div><!-- End .product -->
            @empty 
                <p class="text-center">Cart is empty!</p>
            @endforelse

        </div><!-- End .cart-product -->

        <div class="dropdown-cart-total">
            <span>Total</span>

            <span class="cart-total-price">BDT {{ $sub_total }}</span>
        </div><!-- End .dropdown-cart-total -->

        <div class="dropdown-cart-action">
            <a href="{{ route('cart') }}" class="btn btn-primary">View Cart</a>
            <a href="{{ route('checkout') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
        </div><!-- End .dropdown-cart-total -->

    </div><!-- End .dropdown-menu -->
</div><!-- End .cart-dropdown -->