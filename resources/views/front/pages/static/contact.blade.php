<x-front.master-layout title="Contact">

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


    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contact</li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="page-header page-header-big text-center" style="background-image: url({{ asset('assets/images/contact-header-bg.jpg') }})">
            <h1 class="page-title text-white">Contact us<span class="text-white">keep in touch with us</span></h1>
        </div><!-- End .page-header -->
    </div><!-- End .container -->

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    <h2 class="title mb-1">Contact Information</h2><!-- End .title mb-2 -->
                    <!-- <p class="mb-3">Vestibulum volutpat, lacus a ultrices sagittis, mi neque euismod dui, eu pulvinar nunc sapien ornare nisl. Phasellus pede arcu, dapibus eu, fermentum et, dapibus sed, urna.</p> -->
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="contact-info">
                                <h3>Rayat Boutique &amp; Craft Limited</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-map-marker"></i>
                                        Factory &amp; Head Office- Dhorompur, Bogura Sadar, Bogura-5800
                                    </li>
                                    <li>
                                        <i class="icon-map-marker"></i>
                                        Dhaka Office- House#30, Road#11, Kallyanpur, Dhaka-1216
                                    </li>
                                    <li>
                                        <i class="icon-phone"></i>
                                        <a href="tel:#">+8809644776611, +8809649776611</a>
                                    </li>
                                    <li>
                                        <i class="icon-envelope"></i>
                                        <a href=""><span class="__cf_email__" data-cfemail="4e272028210e032122222f602d2123">customercare@rayat.com.bd</span></a>
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-7 -->

                        <div class="col-sm-5">
                            <div class="contact-info">
                                <h3>The Office</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-clock-o"></i>
                                        <span class="text-dark">Saturday - Thursday</span> <br>11am-7pm
                                    </li>
                                    <li>
                                        <i class="icon-calendar"></i>
                                        <span class="text-dark">Friday</span> <br>11am-6pm
                                    </li>
                                </ul><!-- End .contact-list -->
                            </div><!-- End .contact-info -->
                        </div><!-- End .col-sm-5 -->
                    </div><!-- End .row -->
                </div><!-- End .col-lg-6 -->
                <div class="col-lg-6">
                    <h2 class="title mb-1">Got Any Questions?</h2><!-- End .title mb-2 -->
                    <p class="mb-2">Use the form below to get in touch with the sales team</p>

                    <form action="#" class="contact-form mb-3">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" class="form-control" id="cname" placeholder="Name *" required>
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" class="form-control" id="cemail" placeholder="Email *" required>
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="tel" class="form-control" id="cphone" placeholder="Phone">
                            </div><!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="csubject" class="sr-only">Subject</label>
                                <input type="text" class="form-control" id="csubject" placeholder="Subject">
                            </div><!-- End .col-sm-6 -->
                        </div><!-- End .row -->

                        <label for="cmessage" class="sr-only">Message</label>
                        <textarea class="form-control" cols="30" rows="4" id="cmessage" required placeholder="Message *"></textarea>

                        <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>SUBMIT</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form><!-- End .contact-form -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->

            <hr class="mt-4 mb-5">

            <div class="stores mb-4 mb-lg-5">
                <h2 class="title text-center mb-3">Our Stores</h2><!-- End .title text-center mb-2 -->

                <div class="row">
                    <div class="col-lg-6">
                        <div class="store">
                            <div class="row">
                                <div class="col-sm-5 col-xl-6">
                                    <figure class="store-media mb-2 mb-lg-0">
                                        <img src="{{ asset('assets/images/stores/bogura-showroom.jpg') }}" alt="image">
                                    </figure><!-- End .store-media -->
                                </div><!-- End .col-xl-6 -->
                                <div class="col-sm-7 col-xl-6">
                                    <div class="store-content">
                                        <h3 class="store-title">Bogura</h3><!-- End .store-title -->
                                        <address>Somir uddin Market, Monihar Jewellers 1st Floor, Bogura New Market, Bogura -5800</address>
                                        <div><a href="tel:#">+8809644776611</a></div>

                                        <h4 class="store-subtitle">Store Hours:</h4><!-- End .store-subtitle -->
                                        <div>Saturday - Thursday 11am to 8pm</div>
                                        <div>Friday -  Close</div>

                                        <a href="#" class="btn btn-link" target="_blank"><span>View Map</span><i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .store-content -->
                                </div><!-- End .col-xl-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .store -->
                    </div><!-- End .col-lg-6 -->

                    <div class="col-lg-6">
                        <div class="store">
                            <div class="row">
                                <div class="col-sm-5 col-xl-6">
                                    <figure class="store-media mb-2 mb-lg-0">
                                        <img src="{{ asset('assets/images/stores/dhaka-showroom.jpg') }}" alt="image">
                                    </figure><!-- End .store-media -->
                                </div><!-- End .col-xl-6 -->

                                <div class="col-sm-7 col-xl-6">
                                    <div class="store-content">
                                        <h3 class="store-title">Dhaka</h3><!-- End .store-title -->
                                        <address>House#30, Road#11, Kallyanpur, Dhaka-1216</address>
                                        <div><a href="tel:#">++8809649776611</a></div>

                                        <h4 class="store-subtitle">Store Hours:</h4><!-- End .store-subtitle -->
                                        <div>Saturday - Thursday 11am to 8pm</div>
                                        <div>Friday - Close</div>
                                                                         <a href="#" class="btn btn-link" target="_blank"><span>View Map</span><i class="icon-long-arrow-right"></i></a>
                                    </div><!-- End .store-content -->
                                </div><!-- End .col-xl-6 -->
                            </div><!-- End .row -->
                        </div><!-- End .store -->
                    </div><!-- End .col-lg-6 -->
                </div><!-- End .row -->
            </div><!-- End .stores -->
        </div><!-- End .container -->
    </div><!-- End .page-content -->

</x-front.master-layout>

@push('scripts')

