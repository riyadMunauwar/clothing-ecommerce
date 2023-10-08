<div class="cart">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <table class="table table-cart table-mobile">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($cart_items as $item)
                            <tr>
                                <td class="product-col">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="{{ route('product', ['product_slug' => $item->options->slug, 'id' => $item->id]) }}">
                                                <img src="{{ $item->options->thumbnail }}" alt="{{ $item->name }}">
                                            </a>
                                        </figure>

                                        <h3 class="product-title">
                                            <a href="{{ route('product', ['product_slug' => $item->options->slug, 'id' => $item->id]) }}">{{ $item->name }}</a>
                                        </h3><!-- End .product-title -->
                                    </div><!-- End .product -->
                                </td>
                                <td class="price-col">BDT {{ number_format($item->price, 2) }}</td>

                                <td class="quantity-col">
                                    <livewire:front.cart-quantity-changer :qty="$item->qty" :rowId="$item->rowId" :key="$item->rowId" />
                                </td>
                                
                                <td class="total-col">BDT {{ number_format($item->qty * $item->price, 2) }}</td>
                                <td class="remove-col"><button wire:click.debounce="removeCartItemByRowId('{{ $item->rowId }}')" class="btn-remove"><i class="icon-close"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table><!-- End .table table-wishlist -->

                <div class="cart-bottom">

                <!-- Coupon Discount -->

                    <!-- <div class="cart-discount">
                        <form action="#">
                            <div class="input-group">
                                <input type="text" class="form-control" required placeholder="coupon code">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div> -->

                    <button wire:click.debounce="removeAll" class="btn btn-outline-dark-2"><span wire:loading.remove wire:target="removeAll">RESET CART</span> <span wire:loading wire:target="removeAll">RESETING...</span><i class="icon-refresh"></i></button>
                </div><!-- End .cart-bottom -->
            </div><!-- End .col-lg-9 -->
            <aside class="col-lg-3">
                <div class="summary summary-cart">
                    <h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

                    <table class="table table-summary">
                        <tbody>
                            <tr class="summary-subtotal">
                                <td>Subtotal:</td>
                                <td>BDT {{ number_format($sub_total, 2) }}</td>
                            </tr><!-- End .summary-subtotal -->
                            <tr class="summary-shipping">
                                <td>Shipping:</td>
                                <td>&nbsp;</td>
                            </tr>

                            @foreach(config('shipping_methods') as $index => $method)
                                <tr class="summary-shipping-row">
                                    <td>
                                        <div class="custom-control custom-radio">
                                            <input wire:model.debounce="shipping_method" value="{{$method['shipper'] . '-' . $method['delivery_cost']}}" type="radio" id="shipping-method-{{ $index }}" name="shipping-method" class="custom-control-input">
                                            <label class="custom-control-label" for="shipping-method-{{ $index }}">
                                                <span class="text-md">{{ $method['shipper'] ?? $method['area'] }}</span>
                                                <span class="d-block text-sm"> {{ $method['area'] }} </span>
                                                <span class="d-block text-sm"> {{ $method['estimate_delivery_time'] }} </span>
                                            </label>
                                        </div><!-- End .custom-control -->
                                    </td>
                                    <td>BDT {{ number_format($method['delivery_cost'], 2) }}</td>
                                </tr><!-- End .summary-shipping-row -->
                            @endforeach
    

                            <tr class="summary-total">
                                <td>Total:</td>
                                <td>BDT {{ number_format($total, 2) }}</td>
                            </tr><!-- End .summary-total -->
                        </tbody>
                    </table><!-- End .table table-summary -->

                    <button wire:click="goToCheckout" class="btn btn-outline-primary-2 btn-order btn-block"><span wire:loading.remove wire:target="goToCheckout">PROCEED TO CHECKOUT</span> <span wire:loading wire:target="goToCheckout">LOADING...</span></button>
                </div><!-- End .summary -->

                <a href="/" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
            </aside><!-- End .col-lg-3 -->
        </div><!-- End .row -->
    </div><!-- End .container -->
</div><!-- End .cart -->


