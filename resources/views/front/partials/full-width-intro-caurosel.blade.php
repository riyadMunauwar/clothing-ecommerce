<div class="intro-slider-container mb-4">
    <div class="intro-slider owl-carousel owl-simple owl-nav-inside" data-toggle="owl" data-owl-options='{
            "nav": false, 
            "dots": true,
            "autoplay":true,
            "autoplayTimeout":3000,
            "autoplayHoverPause":true,
            "responsive": {
                "992": {
                    "nav": true,
                    "dots": false
                }
            }
        }'>

        <div class="intro-slide" style="background-image: url('{{ asset('assets/images/caurosels/saree-collection.webp') }}');">
            <!-- <div class="container intro-content">
                <h3 class="intro-subtitle text-primary">all at 50% off</h3>
                <h1 class="intro-title text-white">The Most Beautiful <br>Novelties In Our Shop</h1>

                <a href="category.html" class="btn btn-outline-primary-2 min-width-sm">
                    <span>SHOP NOW</span>
                    <i class="icon-long-arrow-right"></i>
                </a>
            </div> -->
        </div>

        <div class="intro-slide" style="background-image: url('{{ asset('assets/images/caurosels/selowar.webp') }}');">
            
            <!-- <div class="container intro-content">

                <h3 class="intro-subtitle text-primary">SEASONAL PICKS</h3>
                <h1 class="intro-title">Get All <br>The Good Stuff</h1>

                <a href="category.html" class="btn btn-outline-primary-2">
                    <span>DISCOVER MORE</span>
                    <i class="icon-long-arrow-right"></i>
                </a>

            </div> -->

        </div><!-- End .intro-slide -->

        <div class="intro-slide" style="background-image: url('{{ asset('assets/images/caurosels/home-decor.webp') }}');">
            <!-- <div class="container intro-content">
                <h3 class="intro-subtitle text-primary">all at 50% off</h3>
                <h1 class="intro-title text-white">The Most Beautiful <br>Novelties In Our Shop</h1>

                <a href="category.html" class="btn btn-outline-primary-2 min-width-sm">
                    <span>SHOP NOW</span>
                    <i class="icon-long-arrow-right"></i>
                </a>
            </div> -->
        </div>
        
    </div>

    <span class="slider-loader"></span><!-- End .slider-loader -->
</div><!-- End .intro-slider-container -->



@push('styles')

        <style>
            
            .intro-slider-container,
            .intro-slide {
                height: 360px;
                background-color: #eee; 
            }

            .intro-slide {
                display: flex;
                align-items: center;
                background-size: cover;
                background-position: center center; 
            }
            .intro-slide .intro-content {
                position: static;
                left: auto;
                top: auto;
                transform: translateY(0);
                -ms-transform: translateY(0); 
            }

            .intro-subtitle {
                font-weight: 300;
                font-size: 1.2rem;
                text-transform: uppercase;
                letter-spacing: 0;
                margin-bottom: 1rem; 
            }

            .intro-title {
                color: #333333;
                font-weight: 300;
                letter-spacing: -.025em;
                margin-bottom: 1rem; 
            }

            .owl-simple .owl-nav [class*='owl-'] {
                font-size: 2.2rem;
                color: #777; 
            }

            .owl-simple.owl-nav-inside .owl-nav .owl-prev {
                left: 5%; 
            }

            .owl-simple.owl-nav-inside .owl-nav .owl-next {
                right: 5%; 
            }

            .owl-simple.owl-nav-inside .owl-dots {
                bottom: 20px; 
            }


            @media screen and (min-width: 576px) {
            .intro-slider-container,
            .intro-slide {
                height: 400px; } }
            @media screen and (min-width: 768px) {
            .intro-slider-container,
            .intro-slide {
                height: 450px; }

            .intro-subtitle {
                font-size: 1.4rem;
                margin-bottom: 1.2rem; } }
            @media screen and (min-width: 992px) {
            .intro-slider-container,
            .intro-slide {
                height: 480px; }

            .intro-content .btn {
                min-width: 170px; }
            .intro-content .min-width-sm {
                min-width: 150px; }

            .intro-subtitle {
                font-size: 1.6rem;
                margin-bottom: 1.5rem; }

            .intro-title {
                font-size: 4.6rem;
                margin-bottom: 1.7rem; } }
            @media screen and (min-width: 1200px) {
            .intro-slider-container,
            .intro-slide {
                height: 560px; }

            .intro-content .btn {
                min-width: 190px; }

            .intro-title {
                font-size: 5rem; } }

        </style>

@endpush