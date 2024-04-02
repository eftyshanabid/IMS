<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <title>{{ languageValue(websiteSettings()->name) }} | {{translate('LogIn')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content=" "/>
    <meta name="keywords" content="YbCustomer Area, Larasoft"/>
    <meta name="description" content="{{ languageValue(websiteSettings()->slogan) }}"/>
    <meta name="author" content="the LaraSoft">
    <meta name="og:title"
          content="{{ languageValue(websiteSettings()->name) }} | Login"/>
    <meta name="og:type" content="website"/>
    <meta name="og:url" content="{{url('/')}}"/>
    <meta name="og:image"
          content="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}"/>
    <meta name="og:site_name" content="sanajinx.net"/>
    <meta name="og:description"
          content="{{ languageValue(websiteSettings()->slogan) }}"/>

    <link rel="shortcut icon" href="{{asset(websiteSettings()->favicon)}}">
    <script src="{{url('backend')}}/assets/js/hyper-config.js"></script>
    <link href="{{url('backend')}}/assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="{{url('backend')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
    <script async src="https://www.google.com/recaptcha/api.js"></script>
</head>

<body class="authentication-bg">
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">
                    <div class="card-header pt-4 pb-4 text-center">
                        <a href="{{url('/')}}">
                            <span>
                                <img
                                    src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}"
                                    alt="logo"
                                    height="100">
                            </span>
                        </a>
                    </div>
                    <div class="card-body p-4">
                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center pb-0 fw-bold">{{translate('Log In')}}</h4>
                            <p class="text-muted mb-4">{{translate('Please enter your valid username and password.')}}</p>
                        </div>
                        <div class="text-left w-75 m-auto">
                            <x-auth-session-status class="mb-4"
                                                   :status="session('status')"/>
                            <x-auth-validation-errors class="mb-4" :errors="$errors"/>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">{{translate('Email address')}}</label>
                                <input class="form-control" type="email" id="email" name="email" required
                                       placeholder="Enter your email" value="{{old('email')}}">
                            </div>
                            <div class="mb-3">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                       class="text-muted float-end"><small>{{translate('Forgot Your Password?')}}</small></a>
                                @endif

                                <label for="password" class="form-label">{{translate('Password')}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control"
                                           placeholder="Enter your password" required
                                           autocomplete="current-password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>

                            {{--                            <div class="g-recaptcha mt-4" data-sitekey={{config('services.recaptcha.key')}}></div>--}}

                            <div class="mb-3 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember_me"
                                           name="remember">
                                    <label class="form-check-label"
                                           for="remember_me">{{translate('Remember Me')}}</label>
                                </div>
                            </div>

                            <div class="mb-3 mb-0 text-center">
                                <button class="btn btn-primary" type="submit">{{translate('LogIn')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    @if (Route::has('register'))
                        <div class="col-12 text-center">
                            <p class="text-muted">{{translate('Dont Have Account')}} <a href="{{ route('register') }}"
                                                                                        class="text-muted ms-1"><b>{{translate('SignUp')}}</b></a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer footer-alt">
    © {{date('Y')}} -
    <span>{{ languageValue(websiteSettings()->name) }} v{{ Illuminate\Foundation\Application::VERSION }} </span>
    {{ languageValue(websiteSettings()->name) }}
    . {{translate('Design And Developed By')}} {{translate('Bizz Solutions PLC')}}
    </p>
</footer>
<script src="{{url('backend')}}/assets/js/vendor.min.js"></script>
<script src="{{url('backend')}}/assets/js/app.min.js"></script>
</body>
</html>
