<div class="checkout">
    <div class="container">

    @if($errors->any())
        <div class="mb-3">

            @foreach($errors->all() as $error)
                <div class="alert alert-warning mb-1" role="alert">
                    {{ $error }}
                </div>
            @endforeach

        </div>
    @endif

    @if (session('message'))
        <div class="alert alert-warning mb-2">
            {{ session('message') }}
        </div>
    @endif
    
        <!-- Discount Coupon -->
        <!-- <div class="checkout-discount">
            <form action="#">
                <input type="text" class="form-control" required id="checkout-discount-input">
                <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
            </form>
        </div> -->


        <!-- Existing Address -->

        @if(count($addresses) > 0)
        <h2 class="checkout-title">Use Existing Address</h2><!-- End .checkout-title -->

        <div>
            @foreach($addresses as $address)
                <div class="custom-control custom-radio mb-3">
                    <input value="cash-on-delivery" wire:model.debounce="address_id" value="{{ $address->id }}" type="radio" id="address-{{ $address->id }}" name="address_id" class="custom-control-input">
                    <label class="custom-control-label" for="address-{{ $address->id }}">
                        {!! $address->addressHtml() !!}
                    </label>
                </div>
            @endforeach
            <!-- <div class="custom-control custom-radio mb-3">
                <input value="cash-on-delivery" wire:model.debounce="address_id" value="" type="radio" id="address-new" name="address_id" class="custom-control-input">
                <label class="custom-control-label" for="address-new">
                    New address
                </label>
            </div> -->
    </div>
        @endif

        <div>
            <div class="row">
                <div class="col-lg-9">
                    @if(!$address_id)
                    <h2 class="checkout-title">New Shipping Details</h2><!-- End .checkout-title -->
                        <div class="row">
                            <div class="col-sm-6">
                                <label>First Name *</label>
                                <input wire:model.debounce="first_name" type="text" class="form-control" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label>Last Name *</label>
                                <input wire:model.debounce="last_name" type="text" class="form-control" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <label>Email address *</label>
                        <input wire:model.debounce="email" type="email" class="form-control" required>

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Town / City *</label>
                                <input wire:model.debounce="city" type="text" class="form-control" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label>State / County *</label>
                                <input wire:model.debounce="state" type="text" class="form-control" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Postcode / ZIP *</label>
                                <input wire:model.debounce="zip" type="text" class="form-control" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label>Phone *</label>
                                <input wire:model.debounce="mobile_no" type="tel" class="form-control" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->


                        <label>Street address *</label>
                        <input wire:model.debounce="street_address" type="text" class="form-control" placeholder="House number and Street name" required>

                    @endif
                        <label>Order notes (optional)</label>
                        <textarea wire:model.debounce="order_notes" class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                
                </div><!-- End .col-lg-9 -->
                <aside class="col-lg-3">
                    <div class="summary">
                        <h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

                        <table class="table table-summary">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($cartItems as $item)
                                    <tr>
                                        <td><a href="#">{{ $item->name ?? '' }}</a></td>
                                        <td>BDT {{ $item->qty }} * {{ $item->price }}</td>
                                    </tr>
                                @endforeach

                                <tr class="summary-subtotal">
                                    <td>Subtotal:</td>
                                    <td>BDT {{ number_format($subTotal, 2) }}</td>
                                </tr><!-- End .summary-subtotal -->
                                <tr>
                                    <td>Shipping:</td>
                                    <td>BDT {{ $shippingCost }}</td>
                                </tr>
                                <tr class="summary-total">
                                    <td>Total:</td>
                                    <td>BDT {{ number_format($total, 2) }}</td>
                                </tr><!-- End .summary-total -->
                            </tbody>
                        </table><!-- End .table table-summary -->

                        <div>
                            <div class="custom-control custom-radio">
                                <input value="cash-on-delivery" wire:model.debounce="payment_method_option" type="radio" id="payment-method-cash-on" name="payment-method" class="custom-control-input">
                                <label class="custom-control-label" for="payment-method-cash-on">
                                    Cash On Delivery
                                </label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input value="delivery-charge-only" wire:model.debounce="payment_method_option" type="radio" id="payment-method-delivery-charge-only" name="payment-method" class="custom-control-input">
                                <label class="custom-control-label" for="payment-method-delivery-charge-only">
                                    Delivery Charge Only
                                </label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input value="aamarpay" wire:model.debounce="payment_method_option" type="radio" id="payment-method-aamarpay" name="payment-method" class="custom-control-input">
                                <label class="custom-control-label" for="payment-method-aamarpay">
                                    <img class="payment-method-img " src="{{ asset('assets/images/aamarpay_logo.png') }}" alt="Aamarpay-logo">
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input wire:model.debounce="terms_and_condition" name="terms" type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                <label class="custom-control-label" for="register-policy-2">I agree to the <a href="{{ route('tos') }}" >Terms of Service</a> & <a href="{{ route('return-and-refund') }}">refund, return</a> & <a href="{{ route('cancellation-policy') }}">cancellation</a> policy</label>
                            </div>
                        </div>

                        <button wire:click.debounce="startPayment" type="button" class="btn btn-outline-primary-2 btn-order btn-block">
                            <span class="btn-text" wire:loading.remove wire:target="startPayment">Place Order</span>
                            <span class="btn-text" wire:loading wire:target="startPayment">Procesing...</span>
                            <span class="btn-hover-text" wire:loading.remove wire:target="startPayment">Proceed for payment</span>
                        </button>
                    </div><!-- End .summary -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div>

    </div><!-- End .container -->
</div><!-- End .checkout -->

@push('styles')
    <style>

        .payment-method-img {
            display: block;
            object-fit: contain;
            height: 40px;
        }

    </style>
@endpush