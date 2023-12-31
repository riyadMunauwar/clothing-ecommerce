<div>
    <h5>Your Orders</h5>

    @if(!$orders->isEmpty())
        <table class="table table-cart table-mobile">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Items</th>
                    <th>Shipping Charge</th>
                    <th>Total</th>
                    <th>Stats</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>
                            <div class="product">
                                 <h3 class="product-title">
                                    <a>#{{ $order->order_no }}</a>
                                </h3><!-- End .product-title -->
                            </div><!-- End .product -->
                        </td>
                        <td>{{ $order->order_items_count }}</td>
                        <td>
                            BDT {{ $order->shipping_price }}
                        </td>
                        <td>
                             BDT {{ $order->total_price }}
                        </td>
                        <td>
                             <span class="badge badge-info">{{ $order->order_status }}</span> </br>
                             <span class="badge badge-primary">{{ $order->payment_status }}</span> </br>
                        </td>
   
                        <td><button class="btn-remove"><i class="icon-edit"></i></button></td>
                    </tr>
                @endforeach 
            </tbody>
        </table><!-- End .table table-wishlist -->
    @else 
        <p>No order has been made yet.</p>
        <a href="/" class="btn btn-outline-primary-2"><span>GO SHOP</span><i class="icon-long-arrow-right"></i></a>
    @endif
</div>
