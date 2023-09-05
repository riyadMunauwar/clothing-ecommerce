<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ $title ?? 'Rayat Boutique' }}</title>
        <meta name="keywords" content="HTML5 Template">
        <meta name="description" content="Molla - Bootstrap eCommerce Template">
        <meta name="author" content="p-themes">

        <!-- CSRF TOKEN -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="assets/images/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="assets/images/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="assets/images/icons/favicon-16x16.png">
        <link rel="manifest" href="assets/images/icons/site.html">
        <link rel="mask-icon" href="assets/images/icons/safari-pinned-tab.svg" color="#666666">
        <link rel="shortcut icon" href="assets/images/icons/favicon.ico">
        <meta name="apple-mobile-web-app-title" content="Rayat Boutique">
        <meta name="application-name" content="Molla">
        <meta name="msapplication-TileColor" content="#cc9966">
        <meta name="msapplication-config" content="assets/images/icons/browserconfig.xml">
        <meta name="theme-color" content="#ffffff">
        <!-- End Favicon -->
        
        {{ $meta_tags ?? '' }}



        <!-- Plugins CSS File -->


        <!-- Styles For This Page -->
        @stack('styles')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front/css/plugins/owl-carousel/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front/css/plugins/magnific-popup/magnific-popup.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front/css/plugins/jquery.countdown.css') }}">
        
        <!-- Main CSS File -->
        <link rel="stylesheet" href="{{ asset('assets/front/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front/css/plugins/nouislider/nouislider.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/front/css/demos/demo-11.css') }}">

        <!-- Sweet Alert -->
        <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">

    </head>
    <body>

        <div class="page-wrapper">
            <!-- Header -->
            @include('front.partials.header')
            <!-- Main -->
            <main class="main">
                {{ $slot }}
            </main>
            <!-- Footer -->
            @include('front.partials.footer')
        </div>

        

        @stack('modals')

        @include('front.partials.news-letter-popup')
        @include('front.partials.mobile-nav')

        @stack('scripts')

        @livewireScripts

        <!-- Plugins JS File -->
        
        <script src="{{ asset('assets/front/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/front/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('assets/front/js/jquery.hoverIntent.min.js') }}"></script>
        <script src="{{ asset('assets/front/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('assets/front/js/superfish.min.js') }}"></script>
        <script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('assets/front/js/bootstrap-input-spinner.js') }}"></script>
        <script src="{{ asset('assets/front/js/jquery.elevateZoom.min.js') }}"></script>
        <script src="{{ asset('assets/front/js/bootstrap-input-spinner.js') }}"></script>
        <script src="{{ asset('assets/front/js/jquery.magnific-popup.min.js') }}"></script>

        <!-- Main JS File -->
        <script src="{{ asset('assets/front/js/main.js') }}"></script>
        <script>(function(){var js = "window['__CF$cv$params']={r:'7f1f6be42bccba5c'};_cpo=document.createElement('script');_cpo.nonce='',_cpo.src='../../cdn-cgi/challenge-platform/h/g/scripts/jsd/74ac0d47/invisible.js',document.getElementsByTagName('head')[0].appendChild(_cpo);";var _0xh = document.createElement('iframe');_0xh.height = 1;_0xh.width = 1;_0xh.style.position = 'absolute';_0xh.style.top = 0;_0xh.style.left = 0;_0xh.style.border = 'none';_0xh.style.visibility = 'hidden';document.body.appendChild(_0xh);function handler() {var _0xi = _0xh.contentDocument || _0xh.contentWindow.document;if (_0xi) {var _0xj = _0xi.createElement('script');_0xj.innerHTML = js;_0xi.getElementsByTagName('head')[0].appendChild(_0xj);}}if (document.readyState !== 'loading') {handler();} else if (window.addEventListener) {document.addEventListener('DOMContentLoaded', handler);} else {var prev = document.onreadystatechange || function () {};document.onreadystatechange = function (e) {prev(e);if (document.readyState !== 'loading') {document.onreadystatechange = prev;handler();}};}})();</script></body>


        <!-- Sweet Alert -->
        <script src="{{ asset('assets/sweetalert2/sweetalert2.min.js') }}"></script>

        <!-- Sweet Alert Cinfig -->
        <script>

            @if(session()->has('swalToastOptions'))

                @php 
                    $swalToastOption = session('swalToastOptions');
                @endphp 

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    confirmButtonColor: '',
                    timer: 3000,
                    timerProgressBar: true,
                    color: "{{ $swalToastOption['color'] }}",
                    iconColor: "{{ $swalToastOption['iconColor'] }}",
                    background: "{{ $swalToastOption['background'] }}",
                });
                
                Toast.fire({
                    icon: "{{ $swalToastOption['icon'] }}",
                    title: "{{ $swalToastOption['title'] }}",
                })

            @endif

            @if(session()->has('swalAlertOptions'))

                @php 
                    $swalOption = session('swalAlertOptions');
                @endphp 

                Swal.fire({
                    showConfirmButton: true,
                    confirmButtonColor: '',
                    color: "{{ $swalOption['color'] }}",
                    iconColor: "{{ $swalOption['iconColor'] }}",
                    background: "{{ $swalOption['background'] }}",
                    icon: "{{ $swalOption['icon'] }}",
                    title: "{{ $swalOption['title'] }}",
                    text: "{{ $swalOption['text'] }}",
                });

            @endif

            window.addEventListener("DOMContentLoaded", function(){
                
                window.addEventListener('swal:toast', function(event){

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        confirmButtonColor: '',
                        timer: 3000,
                        timerProgressBar: true,
                        color: event.detail.color,
                        iconColor: event.detail.iconColor,
                        background: event.detail.background,
                    });
                    
                    Toast.fire({
                        icon: event.detail.icon,
                        title: event.detail.title,
                    })

                })

                window.addEventListener('swal:alert', function(event){

                    Swal.fire({
                        showConfirmButton: true,
                        color: event.detail.color,
                        iconColor: event.detail.iconColor,
                        background: event.detail.background,
                        icon: event.detail.icon,
                        title: event.detail.title,
                        text: event.detail.text,
                    });

                })

                window.addEventListener('swal:confirm', function(event){

                    Swal.fire({
                        showConfirmButton: true,
                        showCancelButton: true,
                        showCloseButton: true,
                        confirmButtonText: 'Yes, Delete it !',
                        cancelButtonText: 'Cacnel',
                        confirmButtonColor: '',
                        cancelButtonColor: '',
                        color: event.detail.color,
                        iconColor: event.detail.iconColor,
                        background: event.detail.background,
                        icon: event.detail.icon,
                        title: event.detail.title,
                        text: event.detail.text,
                        buttons: true,
                        dangerMode: true,
                    })
                    .then(function({isConfirmed}){

                        if(isConfirmed){
                            window.livewire.emit(event.detail.event, event.detail.payload)
                        }

                    })

                })
            });

        </script>
    </body>
</html>
