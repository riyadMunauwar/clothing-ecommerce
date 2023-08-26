<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Sweet Alert -->
        <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.min.css') }}">

        <!-- Styles For This Page -->
        @stack('styles')

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles

        <style>
            [x-cloak] { display: none !important; }
        </style>

    </head>
    <body x-data="{ isNavigationOpen: false }" class="font-sans antialiased bg-gray-200">

        @include('admin.partials.sidebar')

        @include('admin.partials.header')

        <main class="md:ml-52">
            <div class="container mx-auto md:p-5">
                {{ $slot }}
            </div>
        </main>


        @stack('modals')

        @stack('scripts')

        @livewireScripts

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
