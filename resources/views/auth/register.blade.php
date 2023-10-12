<x-front.master-layout title="Register">

    <x-slot name="meta_tags">

        <!-- Primary Meta Tags -->
        <meta name="title" content="Register">
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
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Register</li>
            </ol>
        </div>
    </nav>


    <div class="login-page bg-image pt-8 pb-8 pt-md-12 pb-md-12 pt-lg-17 pb-lg-17" style="background-image: url({{ asset('assets/images/login-bg.jpg') }})">
        <div class="container">
            <div class="form-box">
                @if($errors->any())
                    <div class="mb-2">
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

                <div class="form-tab">
                    <ul class="nav nav-pills nav-fill" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="signin-tab-2" data-toggle="tab" href="#signin-2" role="tab" aria-controls="signin-2" aria-selected="false">Sign In</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" id="register-tab-2" data-toggle="tab" href="#register-2" role="tab" aria-controls="register-2" aria-selected="true">Register</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane fade" id="signin-2" role="tabpanel" aria-labelledby="signin-tab-2">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="singin-email-2">Username or email address *</label>
                                    <input id="singin-email-2"  type="email" name="email" :value="old('email')" class="form-control" id="singin-email-2" name="singin-email" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="singin-password-2">Password *</label>
                                    <input type="password" class="form-control" id="singin-password-2" name="password" required>
                                </div><!-- End .form-group -->

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>LOG IN</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>

                                    <div class="custom-control custom-checkbox">
                                        <input name="remember" type="checkbox" class="custom-control-input" id="signin-remember-2">
                                        <label class="custom-control-label" for="signin-remember-2">Remember Me</label>
                                    </div><!-- End .custom-checkbox -->

                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="forgot-link">Forgot Your Password?</a>
                                    @endif
                                </div><!-- End .form-footer -->
                            </form>
                            <div class="form-choice">
                                <p class="text-center">or sign in with</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="{{ route('auth-google-redirect') }}" class="btn btn-login btn-g">
                                            <i class="icon-google"></i>
                                            Login With Google
                                        </a>
                                    </div><!-- End .col-6 -->
                                    <div class="col-sm-6">
                                        <a href="{{ route('auth-facebook-redirect') }}" class="btn btn-login btn-f">
                                            <i class="icon-facebook-f"></i>
                                            Login With Facebook
                                        </a>
                                    </div><!-- End .col-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .form-choice -->
                        </div><!-- .End .tab-pane -->

                        @php 
                            $queryParam = request()->query('redirect') ? request()->query('redirect'): false;
                        @endphp

                        <div class="tab-pane fade show active" id="register-2" role="tabpanel" aria-labelledby="register-tab-2">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf 

                                @if($queryParam)
                                    <input type="hidden" name="redirect" value="{{ $queryParam }}">
                                @endif 

                                <div class="form-group">
                                    <label for="name">Your name *</label>
                                    <input type="text" class="form-control" id="name" name="name" :value="old('name')" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="register-email-2">Your email address *</label>
                                    <input type="email" class="form-control" id="register-email-2" name="email" :value="old('email')" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="register-password-2">Password *</label>
                                    <input type="password" class="form-control" id="register-password-2" name="password" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    <label for="register-password-2">Password Confirm *</label>
                                    <input type="password" class="form-control" id="register-password-2" name="password_confirmation" required>
                                </div><!-- End .form-group -->

                                <div class="form-group">
                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                        <div class="custom-control custom-checkbox">
                                            <input name="terms" type="checkbox" class="custom-control-input" id="register-policy-2" required>
                                            <label class="custom-control-label" for="register-policy-2">I agree to the <a href="{{ route('tos') }}">Terms of Service</a> & <a href="{{ route('privacy') }}">privacy policy</a></label>
                                        </div><!-- End .custom-checkbox -->
                                    @endif
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>SIGN UP</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </div><!-- End .form-footer -->
                            </form>
                            <div class="form-choice">
                                <p class="text-center">or sign in with</p>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <a href="{{ route('auth-google-redirect') }}" class="btn btn-login btn-g">
                                            <i class="icon-google"></i>
                                            Login With Google
                                        </a>
                                    </div><!-- End .col-6 -->
                                    <div class="col-sm-6">
                                        <a href="{{ route('auth-facebook-redirect') }}" class="btn btn-login  btn-f">
                                            <i class="icon-facebook-f"></i>
                                            Login With Facebook
                                        </a>
                                    </div><!-- End .col-6 -->
                                </div><!-- End .row -->
                            </div><!-- End .form-choice -->
                        </div><!-- .End .tab-pane -->
                    </div><!-- End .tab-content -->
                </div><!-- End .form-tab -->
            </div><!-- End .form-box -->
        </div><!-- End .container -->
    </div><!-- End .login-page section-bg -->

</x-front.master-layout>
