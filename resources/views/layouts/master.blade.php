<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title> {{ languageValue(websiteSettings()->name) }} | {{ isset($title) ? $title : '' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description"/>
    <meta content="theLaraSoft" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset(websiteSettings()->favicon)}}">
    @include('layouts.css')
    @yield('css')
</head>

<body>
<!-- Begin page -->
<div class="wrapper">

    <!-- ========== Top bar Start ========== -->
    @include('layouts.navbar')
    <!-- ========== Left Sidebar End ========== -->
    <div class="content-page">
        @yield('content')
        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        © {{ languageValue(websiteSettings()->name) }} - {{translate('Bizz Solutions PLC')}}
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-md-block">
                            <a href="javascript: void(0);">{{translate('About')}}</a>
                            <a href="javascript: void(0);">{{translate('Support')}}</a>
                            <a href="javascript: void(0);">{{translate('Contact Us')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
</div>
<!-- END wrapper -->
<div class="modal fade bd-example-modal-md" id="myModal" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header modal-colored-header bg-info">
                <h4 class="modal-title" id="myModal-title">{{translate('Service Details')}}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
            </div>

            <div class="modal-body" id="myModal-body">

            </div>
        </div>
    </div>
</div>
<!-- Theme Settings -->
@include('layouts.theme-settings')

@include('layouts.js')
</body>

</html>
