<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/flatpickr.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/dark.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/owl.carousel.min.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/select2-bootstrap4.min.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/slick-animation.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/slick-theme.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/slick.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/typography.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/style.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/responsive.css') }}">
    <link rel='stylesheet' href="{{ asset('frontend/css/variable.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
<div id="loading">
    <div id="loading-center"></div>
</div>

<div class="content-page">

</div>

@include('layouts.frontend.footer')

<script src="{{asset('frontend/js/jquery-3.4.1.min.js')}}"></script>
<script src="{{asset('frontend/js/flatpickr.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script src="{{asset('frontend/js/slick.min.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/js/select2.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('frontend/js/slick-animation.min.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('frontend/js/custom.js')}}"></script>
<script src="{{asset('js/functions.js')}}"></script>
</body>
</html>
