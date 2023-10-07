<div class="checkout">
    <div class="container">
        <div class="checkout-discount">
            <form action="#">
                <input type="text" class="form-control" required id="checkout-discount-input">
                <label for="checkout-discount-input" class="text-truncate">Have a coupon? <span>Click here to enter your code</span></label>
            </form>
        </div><!-- End .checkout-discount -->
        <form action="#">
            <div class="row">
                <div class="col-lg-9">
                    <h2 class="checkout-title">Billing Details</h2><!-- End .checkout-title -->
                        <div class="row">
                            <div class="col-sm-6">
                                <label>First Name *</label>
                                <input type="text" class="form-control" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label>Last Name *</label>
                                <input type="text" class="form-control" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <label>Company Name (Optional)</label>
                        <input type="text" class="form-control">

                        <label>Country *</label>
                        <input type="text" class="form-control" required>

                        <label>Street address *</label>
                        <input type="text" class="form-control" placeholder="House number and Street name" required>
                        <input type="text" class="form-control" placeholder="Appartments, suite, unit etc ..." required>

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Town / City *</label>
                                <input type="text" class="form-control" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label>State / County *</label>
                                <input type="text" class="form-control" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <label>Postcode / ZIP *</label>
                                <input type="text" class="form-control" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label>Phone *</label>
                                <input type="tel" class="form-control" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <label>Email address *</label>
                        <input type="email" class="form-control" required>

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="checkout-create-acc">
                            <label class="custom-control-label" for="checkout-create-acc">Create an account?</label>
                        </div><!-- End .custom-checkbox -->

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="checkout-diff-address">
                            <label class="custom-control-label" for="checkout-diff-address">Ship to a different address?</label>
                        </div><!-- End .custom-checkbox -->

                        <label>Order notes (optional)</label>
                        <textarea class="form-control" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
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
                                <!-- <tr>
                                    <td><a href="#">Beige knitted elastic runner shoes</a></td>
                                    <td>$84.00</td>
                                </tr>

                                <tr>
                                    <td><a href="#">Blue utility pinafore denimdress</a></td>
                                    <td>$76,00</td>
                                </tr> -->
                                <tr class="summary-subtotal">
                                    <td>Subtotal:</td>
                                    <td>BDT {{ number_format($subTotal, 2) }}</td>
                                </tr><!-- End .summary-subtotal -->
                                <tr>
                                    <td>Shipping:</td>
                                    <td>Free shipping</td>
                                </tr>
                                <tr class="summary-total">
                                    <td>Total:</td>
                                    <td>BDT {{ number_format($subTotal, 2) }}</td>
                                </tr><!-- End .summary-total -->
                            </tbody>
                        </table><!-- End .table table-summary -->

                        <div class="custom-control custom-radio d-flex align-items-sm-center">
                            <input type="radio" id="payment-method" name="payment-method" class="custom-control-input">
                            <label class="custom-control-label" for="payment-method">
                                <img src="{{ asset('assets/images/aamarpay_logo.png') }}" alt="Aamarpay-logo">
                            </label>
                        </div><!-- End .custom-control -->

                        <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input name="terms" type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                    <label class="custom-control-label" for="register-policy-2">I agree to the <a href="{{ route('tos') }}" >Terms of Service</a> & <a href="{{ route('return-and-refund') }}">refund, return</a> & <a href="{{ route('cancellation-policy') }}">cancellation</a> policy</label>
                                </div><!-- End .custom-checkbox -->
                        </div>

                        <button type="button" class="btn btn-outline-primary-2 btn-order btn-block">
                            <span class="btn-text">Place Order</span>
                            <span class="btn-hover-text">Proceed for payment</span>
                        </button>
                    </div><!-- End .summary -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </form>
    </div><!-- End .container -->
</div><!-- End .checkout -->
