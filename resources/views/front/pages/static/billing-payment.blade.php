<x-front.master-layout title="Billing and Payment">

        <x-slot name="meta_tags">

            <!-- Primary Meta Tags -->
            <meta name="title" content="Login">
            <meta name="description" content="">
            <meta name="keywords" content="">
            <meta name="author" content="">

            <!-- Open Graph / Facebook -->
            <meta property="og:type" content="website">
            <meta property="og:url" content="https://laravel.com/">
            <meta property="og:title" content="Laravel - The PHP Framework For Web Artisans">
            <meta property="og:description" content="Laravel is a PHP web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.">
            <meta property="og:image" content="https://laravel.com/img/og-image.jpg">

            <!-- Twitter -->
            <meta property="twitter:card" content="summary_large_image">
            <meta property="twitter:url" content="https://laravel.com/">
            <meta property="twitter:title" content="Laravel - The PHP Framework For Web Artisans">
            <meta property="twitter:description" content="Laravel is a PHP web application framework with expressive, elegant syntax. We’ve already laid the foundation — freeing you to create without sweating the small things.">
            <meta property="twitter:image" content="https://laravel.com/img/og-image.jpg">

        </x-slot />

        <div class="page-header text-center" style="background-image: url('{{ asset('assets/images/page-header-bg.jpg') }}'">
            <div class="container">
                <h1 class="page-title">Billing and Payment</h1>
            </div><!-- End .container -->
        </div><!-- End .page-header -->

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Billing and Payment</li>
                </ol>
            </div><!-- End .container -->
        </nav><!-- End .breadcrumb-nav -->

        <div class="page-content">
            <div class="container">
                <h1 class="title text-center mb-3">Billing and Payment</h1>
                <p>We are using aamarPay payment gateway to receive online payments from our honorable
    customers. It’s a secure and convenient way to manage your account and your time.

                <p class="mt-3">The detail billing and payment options are described here.</p>

                <h6 class="mt-4">Billing</h6>
                <p>After your order has been confirmed a system generated bill will be sent to your email address
or customers will receive a text message to mobile. You will also find a printed copy of your
invoice while receiving the product from our delivery person. Please note, your billing amount
will be shown in Bangladeshi Taka on the payment gateway.</p>


                <h6 class="mt-4">Payment options</h6>
                <p>Rayat products are available for payments by Visa, MasterCard, American Express (debit, credit
and gift cards), Mobile Banking (bKash, Rocket etc) and cash-on-delivery.</p>

                <h6 class="mt-4">Credit Card Payments</h6>
                <p>The total billed amount for your order will be charged to your credit card after your card has
been approved [An OTP (one time password) will be sent to your mobile number that is
attached to your card &amp; after input the password, payment will be completed.]
Your order will automatically cancelled if charged amount exceeds the credit limit on your card.</p>


                <h6 class="mt-4">Debit Card Payments</h6>
                <p>Total billed amount of your order will be charged to your debit card after your card has been
approved. A receipt is generated for each order.</p>


                <h6 class="mt-4">Cash On Delivery</h6>
                <p>You can avail cash on delivery facilities. Since we provide cash on delivery for perishable goods
and it is applicable only for Dhaka &amp; Bogura City. We also provide cash on delivery for
nonperishable goods in whole country.</p>



            </div>
        </div>


</x-front.master-layout>