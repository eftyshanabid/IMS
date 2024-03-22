<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <title>{{env('APP_NAME')}} | Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content=" "/>
    <meta name="keywords" content="Sanajinx"/>
    <meta name="description" content="Sanajinx"/>
    <meta name="author" content="Sanajinx">
    <meta name="og:title"
          content="Sanajinx.net"/>
    <meta name="og:type" content="website"/>
    <meta name="og:url" content="https://sanajinx.net"/>
    <meta name="og:image" content="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}"/>
    <meta name="og:site_name" content="sanajinx.net"/>
    <meta name="og:description"
          content=""/>

    <link rel="shortcut icon" href="{{asset(websiteSettings()->favicon)}}">
    <script src="{{url('backend')}}/assets/js/hyper-config.js"></script>
    <link href="{{url('backend')}}/assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style"/>
    <link href="{{url('backend')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css"/>
</head>
<body class="authentication-bg pb-0">
    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center text-lg-start mb-5">
                        <a href="{{url('/')}}" class="logo-dark">
                            <span><img src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}" alt="dark logo" height="30"></span>
                        </a>
                        <a href="{{url('/')}}" class="logo-light">
                            <span><img src="{{asset(session()->get('language') == 'en' ? websiteSettings()->logo : websiteSettings()->default_user_cover)}}" alt="logo" height="30"></span>
                        </a>
                    </div>

                    <!-- title-->
                    <h4 class="mt-3"></h4>
                    <p class="text-muted mt-4">Don't have an account? Create your account, it takes less than a minute</p>
                    <div class="text-left w-75 m-auto">
                       <x-auth-validation-errors class="mb-4" :errors="$errors" />
                   </div>
                   <!-- form -->
                   <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input class="form-control" type="text" value="{{old('name')}}" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input class="form-control" name="email" type="email" value="{{old('email')}}" id="email" required placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input class="form-control" type="password" name="password" required id="password" placeholder="Enter your password" autocomplete="new-password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input class="form-control" type="password" name="password_confirmation" required id="password_confirmation" placeholder="Enter your password again">
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox-signup">
                            <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-muted">Terms and Conditions</a></label>
                        </div>
                    </div>
                    <div class="mb-0 d-grid text-center">
                        <button class="btn btn-primary" type="submit"><i class="mdi mdi-account-circle"></i> Sign Up </button>
                    </div>

                    <!-- social-->
                    <div class="text-center mt-4">
                        <p class="text-muted font-16">Sign up using</p>
                        <ul class="social-list list-inline mt-3">
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-primary text-primary"><i class="mdi mdi-facebook"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i class="mdi mdi-google"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-info text-info"><i class="mdi mdi-twitter"></i></a>
                            </li>
                            <li class="list-inline-item">
                                <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i class="mdi mdi-github"></i></a>
                            </li>
                        </ul>
                    </div>
                </form>
                <footer class="footer footer-alt">
                    <p class="text-muted">Already have account? <a href="{{route('login')}}" class="text-muted ms-1"><b>Log In</b></a></p>
                </footer>
            </div>
        </div>
    </div>

    <div class="auth-fluid-right text-center">
        <div class="auth-user-testimonial">
            <h2 class="mb-3">I love the color!</h2>
            <p class="lead"><i class="mdi mdi-format-quote-open"></i> It's a elegent software. I love it very much! . <i class="mdi mdi-format-quote-close"></i>
            </p>
            <p>- {{websiteSettings()->name}}</p>
        </div>
    </div>
</div>
<script src="{{url('backend')}}/assets/js/vendor.min.js"></script>
<script src="{{url('backend')}}/assets/js/app.min.js"></script>
</body>
</html>

