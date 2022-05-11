<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Laravel') }}</title>
    
        <!-- Stylesheets -->
        <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="{{ asset('frontend/css/flatpickr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/remixicon.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
        <link rel='stylesheet' href="{{ asset('frontend/css/dark.css') }}">
        <link rel='stylesheet' href="{{ asset('frontend/css/owl.carousel.min.css') }}">
        <link rel='stylesheet' href="{{ asset('frontend/css/select2-bootstrap4.min.css') }}" >
        <link rel='stylesheet' href="{{ asset('frontend/css/select2.min.css') }}" >
        <link rel='stylesheet' href="{{ asset('frontend/css/slick-animation.css') }}" >
        <link rel='stylesheet' href="{{ asset('frontend/css/slick-theme.css') }}" >
        <link rel='stylesheet' href="{{ asset('frontend/css/slick.css') }}" >
        <link rel='stylesheet' href="{{ asset('frontend/css/typography.css') }}" >
        <link rel='stylesheet' href="{{ asset('frontend/css/typography-rtl.css') }}" >
        <link rel='stylesheet' href="{{ asset('frontend/css/spacer.css') }}" >
        <link rel='stylesheet' href="{{ asset('frontend/css/style.css') }}" >
        <link rel='stylesheet' href="{{ asset('frontend/css/responsive.css') }}" >
        <link rel='stylesheet' href="{{ asset('frontend/css/variable.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/bootstrap.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/dark.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/developer.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/dataTables.bootstrap4.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/dripicons.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/flatpickr.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/fontawesome.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/ionicons.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/line-awesome.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/owl.carousel.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/magnific-popup.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/remixicon.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/select2-bootstrap4.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/select2.min.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/slick-theme.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/variable.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/typography.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/typography-rtl.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/style.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/responsive.css') }}" >
        <link rel="stylesheet" href="{{ asset('dashboard/css/spacer.css') }}" >
        <link rel="icon" href="{{ asset('images/logo_icon.png') }}" >

        @yield('page_css')
    </head>
    <body>
        <div id="loading">
            <div id="loading-center"></div>
        </div>
        
        @yield('content')
        
        <!-- Scripts -->
        <script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/flatpickr.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/popper.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/slick.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/jquery.magnific-popup.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/custom.js') }}"></script>
        <script src="{{ asset('dashboard/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/jquery.appear.js') }}"></script>
        <script src="{{ asset('dashboard/js/countdown.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/select2.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/waypoints.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/jquery.counterup.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/wow.min.js') }}"></script>
        <script src="{{ asset('dashboard/js/smooth-scrollbar.js') }}"></script>
        <script src="{{ asset('dashboard/js/apexcharts.js') }}"></script>
        <script src="{{ asset('dashboard/js/chart-custom.js') }}"></script>
        <script src="{{ asset('dashboard/js/rtl.js')  }}"></script>
        @yield('page_js')
    </body>
</html>
