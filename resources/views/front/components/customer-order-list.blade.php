<div>
    <h2>Your Orders</h2>
    <table class="table table-cart table-mobile">
        <thead>
            <tr>
                <th>Order</th>
                <th>ID</th>
                <th>Items</th>
                <th>Total</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td class="product-col">
                        <div class="product">
                            <figure class="product-media">
                                <a href="#">
                                    <img src="assets/images/products/table/product-1.jpg" alt="Product image">
                                </a>
                            </figure>

                            <h3 class="product-title">
                                <a href="#">Beige knitted elastic runner shoes</a>
                            </h3><!-- End .product-title -->
                        </div><!-- End .product -->
                    </td>
                    <td class="price-col">$84.00</td>
                    <td class="quantity-col">
                        <div class="cart-product-quantity">
                            <input type="number" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                        </div><!-- End .cart-product-quantity -->
                    </td>
                    <td class="total-col">$84.00</td>
                    <td class="remove-col"><button class="btn-remove"><i class="icon-close"></i></button></td>
                </tr>
            @empty 
                <p>No order has been made yet.</p>
                <a href="/" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
            @endforelse
        </tbody>
    </table><!-- End .table table-wishlist -->
</div>
