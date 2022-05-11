<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('dashboard/images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link href="{{ asset('destin/css/materialdesignicons.min.css') }}" rel="stylesheet">
    <style>
        /*! CSS Used from: https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css */
        .fa {
            display: inline-block;
            font: normal normal normal 14px/1 FontAwesome;
            font-size: inherit;
            text-rendering: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .fa-twitter:before {
            content: "\f099";
        }

        .fa-facebook:before {
            content: "\f09a";
        }

        /*! CSS Used from: https://preview.colorlib.com/theme/bootstrap/login-form-17/css/A.style.css.pagespeed.cf.PgCMkVC7B9.css */
        *, *::before, *::after {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        section {
            display: block;
        }

        h2, h3 {
            margin-top: 0;
            margin-bottom: .5rem;
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem;
        }

        a {
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
        }

        a:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        label {
            display: inline-block;
            margin-bottom: .5rem;
        }

        button {
            border-radius: 0;
        }

        button:focus {
            outline: 1px dotted;
            outline: 5px auto -webkit-focus-ring-color;
        }

        input, button {
            margin: 0;
            font-family: inherit;
            font-size: inherit;
            line-height: inherit;
        }

        button, input {
            overflow: visible;
        }

        button {
            text-transform: none;
        }

        button, [type="submit"] {
            -webkit-appearance: button;
        }

        button::-moz-focus-inner, [type="submit"]::-moz-focus-inner {
            padding: 0;
            border-style: none;
        }

        input[type="checkbox"] {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
            padding: 0;
        }

        h2, h3 {
            margin-bottom: .5rem;
            font-weight: 500;
            line-height: 1.2;
        }

        h2 {
            font-size: 2rem;
        }

        h3 {
            font-size: 1.75rem;
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 576px) {
            .container {
                max-width: 540px;
            }
        }

        @media (min-width: 768px) {
            .container {
                max-width: 720px;
            }
        }

        @media (min-width: 992px) {
            .container {
                max-width: 960px;
            }
        }

        @media (min-width: 1200px) {
            .container {
                max-width: 1140px;
            }
        }

        .row {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-md-6, .col-md-12, .col-lg-10 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        @media (min-width: 768px) {
            .col-md-6 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 50%;
                flex: 0 0 50%;
                max-width: 50%;
            }

            .col-md-12 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 100%;
                flex: 0 0 100%;
                max-width: 100%;
            }

            .order-md-last {
                -webkit-box-ordinal-group: 14;
                -ms-flex-order: 13;
                order: 13;
            }
        }

        @media (min-width: 992px) {
            .col-lg-10 {
                -webkit-box-flex: 0;
                -ms-flex: 0 0 83.33333%;
                flex: 0 0 83.33333%;
                max-width: 83.33333%;
            }
        }

        .form-control {
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: .25rem;
            -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            -o-transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        }

        @media (prefers-reduced-motion: reduce) {
            .form-control {
                -webkit-transition: none;
                -o-transition: none;
                transition: none;
            }
        }

        .form-control::-ms-expand {
            background-color: transparent;
            border: 0;
        }

        .form-control:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            -webkit-box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
        }

        .form-control::-webkit-input-placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .form-control:-ms-input-placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .form-control::-ms-input-placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .form-control::placeholder {
            color: #6c757d;
            opacity: 1;
        }

        .form-control:disabled {
            background-color: #e9ecef;
            opacity: 1;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .btn {
            display: inline-block;
            font-weight: 400;
            color: #212529;
            text-align: center;
            vertical-align: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            background-color: transparent;
            border: 1px solid transparent;
            padding: .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            border-radius: .25rem;
            -webkit-transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
            -o-transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out;
            transition: color .15s ease-in-out, background-color .15s ease-in-out, border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
        }

        @media (prefers-reduced-motion: reduce) {
            .btn {
                -webkit-transition: none;
                -o-transition: none;
                transition: none;
            }
        }

        .btn:hover {
            color: #212529;
            text-decoration: none;
        }

        a {
            -webkit-transition: .3s all ease;
            -o-transition: .3s all ease;
            transition: .3s all ease;
            color: #f35588;
        }

        a:hover, a:focus {
            text-decoration: none !important;
            outline: none !important;
            -webkit-box-shadow: none;
            box-shadow: none;
        }

        h2, h3 {
            line-height: 1.5;
            font-weight: 400;
            font-family: "Lato", Arial, sans-serif;
            color: #000;
        }

        .ftco-section {
            padding: 7em 0;
        }

        .heading-section {
            font-size: 28px;
            color: #000;
        }

        .wrap {
            width: 100%;
            border-radius: 5px;
            -webkit-box-shadow: 0 10px 34px -15px rgba(0, 0, 0, .24);
            -moz-box-shadow: 0 10px 34px -15px rgba(0, 0, 0, .24);
            box-shadow: 0 10px 34px -15px rgba(0, 0, 0, .24);
        }

        .text-wrap, .login-wrap {
            width: 50%;
        }

        @media (max-width: 991.98px) {
            .text-wrap, .login-wrap {
                width: 100%;
            }
        }

        .text-wrap {
            background: #f75959;
            background: -moz-linear-gradient(-45deg, #f75959 0%, #f35587 100%);
            background: -webkit-gradient(left top, right bottom, color-stop(0%, #f75959), color-stop(100%, #f35587));
            background: -webkit-linear-gradient(-45deg, #f75959 0%, #f35587 100%);
            background: -o-linear-gradient(-45deg, #f75959 0%, #f35587 100%);
            background: -ms-linear-gradient(-45deg, #f75959 0%, #f35587 100%);
            background: -webkit-linear-gradient(315deg, #f75959 0%, #f35587 100%);
            background: -o-linear-gradient(315deg, #f75959 0%, #f35587 100%);
            background: linear-gradient(135deg, #f75959 0%, #f35587 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f75959', endColorstr='#f35587', GradientType=1);
            color: #fff;
        }

        .text-wrap .text h2 {
            font-weight: 900;
            color: #fff;
        }

        .login-wrap {
            position: relative;
            background: #fff;
        }

        .login-wrap h3 {
            font-weight: 300;
        }

        .form-group {
            position: relative;
        }

        .form-group .label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #000;
            font-weight: 700;
        }

        .form-group a {
            color: gray;
        }

        .form-control {
            height: 48px;
            background: rgba(0, 0, 0, .05);
            color: #000;
            font-size: 16px;
            border-radius: 50px;
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 1px solid transparent;
            padding-left: 20px;
            padding-right: 20px;
            -webkit-transition: all .2s ease-in-out;
            -o-transition: all .2s ease-in-out;
            transition: all .2s ease-in-out;
        }

        @media (prefers-reduced-motion: reduce) {
            .form-control {
                -webkit-transition: none;
                -o-transition: none;
                transition: none;
            }
        }

        .form-control::-webkit-input-placeholder {
            color: rgba(0, 0, 0, .2) !important;
        }

        .form-control::-moz-placeholder {
            color: rgba(0, 0, 0, .2) !important;
        }

        .form-control:-ms-input-placeholder {
            color: rgba(0, 0, 0, .2) !important;
        }

        .form-control:-moz-placeholder {
            color: rgba(0, 0, 0, .2) !important;
        }

        .form-control:focus, .form-control:active {
            outline: none !important;
            -webkit-box-shadow: none;
            box-shadow: none;
            background: rgba(0, 0, 0, .07);
            border-color: transparent;
        }

        .social-media {
            position: relative;
            width: 100%;
        }

        .social-media .social-icon {
            display: block;
            width: 40px;
            height: 40px;
            background: transparent;
            border: 1px solid rgba(0, 0, 0, .05);
            font-size: 16px;
            margin-right: 5px;
            border-radius: 50%;
        }

        .social-media .social-icon span {
            color: #999;
        }

        .social-media .social-icon:hover, .social-media .social-icon:focus {
            background: #f35588;
        }

        .social-media .social-icon:hover span, .social-media .social-icon:focus span {
            color: #fff;
        }

        .checkbox-wrap {
            display: block;
            position: relative;
            padding-left: 30px;
            margin-bottom: 12px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .checkbox-wrap input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            height: 0;
            width: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
        }

        .checkmark:after {
            content: "\f0c8";
            font-family: "FontAwesome";
            position: absolute;
            color: rgba(0, 0, 0, .1);
            font-size: 20px;
            margin-top: -4px;
            -webkit-transition: .3s;
            -o-transition: .3s;
            transition: .3s;
        }

        @media (prefers-reduced-motion: reduce) {
            .checkmark:after {
                -webkit-transition: none;
                -o-transition: none;
                transition: none;
            }
        }

        .checkbox-wrap input:checked ~ .checkmark:after {
            display: block;
            content: "\f14a";
            font-family: "FontAwesome";
            color: rgba(0, 0, 0, .2);
        }

        .checkbox-primary {
            color: #f35588;
        }

        .checkbox-primary input:checked ~ .checkmark:after {
            color: #f35588;
        }

        .btn {
            cursor: pointer;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            font-size: 15px;
            padding: 10px 20px;
            border-radius: 50px;
        }

        .btn:hover, .btn:active, .btn:focus {
            outline: none;
        }

        .btn.btn-primary {
            background: #f35588;
            border: none !important;
            color: #fff;
            background: #f75959;
            background: -moz-linear-gradient(-45deg, #f75959 0%, #f35587 100%);
            background: -webkit-gradient(left top, right bottom, color-stop(0%, #f75959), color-stop(100%, #f35587));
            background: -webkit-linear-gradient(-45deg, #f75959 0%, #f35587 100%);
            background: -o-linear-gradient(-45deg, #f75959 0%, #f35587 100%);
            background: -ms-linear-gradient(-45deg, #f75959 0%, #f35587 100%);
            background: -webkit-linear-gradient(315deg, #f75959 0%, #f35587 100%);
            background: -o-linear-gradient(315deg, #f75959 0%, #f35587 100%);
            background: linear-gradient(135deg, #f75959 0%, #f35587 100%) !important;
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f75959', endColorstr='#f35587', GradientType=1);
        }

        .btn.btn-primary:hover {
            border: 1px solid #f35588;
            background: #f35588;
            color: #fff;
        }

        .btn.btn-white {
            background: #fff;
            border: 1px solid #fff;
            color: #fff;
        }

        .btn.btn-white:hover {
            border: 1px solid #fff;
            background: transparent;
            color: #fff;
        }

        .btn.btn-white.btn-outline-white {
            border: 1px solid #fff;
            background: transparent;
            color: #fff;
        }

        .btn.btn-white.btn-outline-white:hover {
            border: 1px solid transparent;
            background: #fff;
            color: #000;
        }

        .wrap.signin .login-wrap {
            border-top-left-radius: 5px !important;
            border-bottom-left-radius: 5px !important;
        }

        .wrap.signin .text-wrap {
            border-top-right-radius: 5px !important;
            border-bottom-right-radius: 5px !important;
        }

        .wrap.signup .text-wrap,
        .wrap.signup .btn-primary {
            background: #FF512F !important; /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #F09819, #FF512F) !important; /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #F09819, #FF512F) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        }

        .wrap.signup .login-wrap {
            border-top-right-radius: 5px !important;
            border-bottom-right-radius: 5px !important;
        }

        .wrap.signup .text-wrap {
            border-top-left-radius: 5px !important;
            border-bottom-left-radius: 5px !important;
        }

        .btn-back {
            position: absolute;
            top: 30px;
        }
    </style>
</head>
<body>
<div id="loading">
    <div id="loading-center"></div>
</div>

<section class="container" style="height: 100vh">
    <div class="row justify-content-center h-100">
        <div class="col-md-12 col-lg-10 my-auto">
            <div class="tab-content">
                <div class="tab-pane @if(!request()->has('purpose')) active @endif" id="signin">
                    <div class="wrap signin d-md-flex">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
                            <a href="/" class="btn-back btn btn-white btn-outline-white bg-white text-dark">
                                <i class="mdi mdi-arrow-left mdi-lg"></i>
                            </a>
                            <div class="text w-100">
                                <h2>Welcome to Sign In</h2>
                                <p>Don't have an account?</p>
                                <a class="btn-signup btn btn-white btn-outline-white" id="signup-tab" data-toggle="tab"
                                   href="#signup">Sign Up</a>
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>
                                {{--                                <div class="w-100">--}}
                                {{--                                    <p class="social-media d-flex justify-content-end">--}}
                                {{--                                        <a href="#"--}}
                                {{--                                           class="social-icon d-flex align-items-center justify-content-center"><span--}}
                                {{--                                                    class="fa fa-facebook"></span></a>--}}
                                {{--                                        <a href="#"--}}
                                {{--                                           class="social-icon d-flex align-items-center justify-content-center"><span--}}
                                {{--                                                    class="fa fa-twitter"></span></a>--}}
                                {{--                                    </p>--}}
                                {{--                                </div>--}}
                            </div>

                            @if ($errors->any())
                                <ul class="list-group">
                                    @foreach ($errors->all() as $error)
                                        <li class="list-group-item list-group-item-danger">
                                            <i class="fa fa-exclamation-triangle mr-1"></i>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <form method="POST" action="{{ route('login') }}" class="signin-form">
                                @csrf

                                <div class="form-group">
                                    <label>{{ __('Email') }}</label>
                                    <input class="form-control mb-0" type="email" name="email" placeholder="Enter your email"
                                           value="{{ old('email') }}" required autofocus/>
                                </div>

                                <div class="form-group mb-4">
                                    <label>{{ __('Password') }}</label>
                                    <input class="form-control mb-0" type="password" name="password" placeholder="Enter your password" required
                                           autocomplete="current-password"/>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary btn-block">
                                        {{ __('Sign In') }}
                                        <i class="mdi mdi-login-variant mr-2"></i>
                                    </button>
                                </div>

                                <div class="form-group d-md-flex">
                                    <div class="w-50 text-left">
                                        <div class="custom-control d-flex align-items-center">
                                            <input type="checkbox" class="custom-control-input" name="remember"
                                                   id="remember">
                                            <label class="custom-control-label" for="remember"
                                                   style="line-height: 25px;">{{ __('Remember me') }}</label>
                                        </div>
                                    </div>
                                    <div class="w-50 text-md-right">
                                        @if (Route::has('password.request'))
                                            <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane @if(request()->has('purpose')) active @endif" id="signup">
                    <div class="wrap signup d-md-flex">
                        <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center">
                            <a href="/" class="btn-back btn btn-white btn-outline-white bg-white text-dark">
                                <i class="mdi mdi-arrow-left mdi-lg"></i>
                            </a>
                            <div class="text w-100">
                                <h2>Welcome to Sign Up</h2>
                                <p>Already have an account?</p>
                                <a class="btn-signin btn btn-white btn-outline-white" id="signin-tab" data-toggle="tab"
                                   href="#signin">Sign In</a>
                            </div>
                        </div>
                        <div class="login-wrap p-4 p-lg-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign Up</h3>
                                </div>
                            </div>

                            @if ($errors->any())
                                <ul class="list-group mb-3">
                                    @foreach ($errors->all() as $error)
                                        <li class="list-group-item list-group-item-danger">
                                            <i class="fa fa-exclamation-triangle mr-1"></i>
                                            {{ $error }}
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            <form method="POST" action="{{ route('register') }}" class="signin-form">
                                @csrf

                                <div class="row">
                                    <fieldset class="col form-group">
                                        <label>{{ __('First Name') }}</label>
                                        <input class="form-control mb-0" type="text" name="firstname"
                                               placeholder="Enter your First Name"
                                               value="{{ old('firstname') }}" required autofocus
                                               autocomplete="firstname"/>
                                    </fieldset>

                                    <fieldset class="col form-group">
                                        <label>{{ __('Last Name') }}</label>
                                        <input class="form-control mb-0" type="text" name="lastname"
                                               placeholder="Enter your Last Name"
                                               value="{{ old('lastname') }}" required autofocus
                                               autocomplete="lastname"/>
                                    </fieldset>
                                </div>

                                <div class="row">
                                    <fieldset class="col form-group">
                                        <label>{{ __('Country') }}</label>
                                        <select class="countries form-control mb-0" name="country" id="countryId"
                                                required>
                                            <option value="">Select Country</option>
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="row">
                                    <fieldset class="col form-group">
                                        <label>{{ __('State') }}</label>
                                        <select class="states form-control mb-0" name="state" id="stateId" required>
                                            <option value="">Select State</option>
                                        </select>
                                    </fieldset>

                                    <fieldset class="col form-group">
                                        <label>{{ __('City') }}</label>
                                        <select class="cities form-control mb-0" name="city" id="cityId" required>
                                            <option value="">Select City</option>
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="row">
                                    <fieldset class="col form-group">
                                        <label>{{ __('Email') }}</label>
                                        <input class="form-control mb-0" type="email" name="email"
                                               placeholder="Enter your email"
                                               value="{{ old('email') }}" required autofocus
                                               autocomplete="email"/>
                                    </fieldset>
                                </div>

                                <div class="row mb-3">
                                    <div class="col form-group">
                                        <label>{{ __('Password') }}</label>
                                        <input class="form-control mb-0" type="password" name="password" placeholder="Enter your password" required
                                               autocomplete="new-password"/>
                                    </div>

                                    <div class="col form-group">
                                        <label>{{ __('Confirm Password') }}</label>
                                        <input class="form-control mb-0" type="password"
                                               name="password_confirmation" placeholder="Enter your confirm password" required autocomplete="new-password"/>
                                    </div>
                                </div>

                                <div class="row">
                                    <fieldset class="col form-group">
                                        <label>{{ __('Gender') }}</label>
                                        <select class="form-control mb-0" name="gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="others">Others</option>
                                        </select>
                                    </fieldset>
                                </div>

                                <div class="row">
                                    <fieldset class="col form-group">
                                        <label>{{ __('Date of Birth') }}</label>
                                        <input type="date" class="form-control mb-0" name="date_of_birth" required>
                                    </fieldset>
                                </div>

                                <div class="row mb-3">
                                    <div class="col form-group">
                                        <label>{{ __('Purpose of Joining') }}</label>
                                        <select class="form-control mb-0" name="role" required>
                                            <option value="">Select Purpose of Joining</option>
                                            <option value="advertiser" @if(request()->has('purpose') && request()->input('purpose') == 1) selected @endif>Advertisement</option>
                                            <option value="channel" @if(request()->has('purpose') && request()->input('purpose') == 2) selected @endif>Starting a New Channel</option>
                                            <option value="user" @if(request()->has('purpose') && request()->input('purpose') == 3) selected @endif>Just for Watching Contents</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="sign-info">
                                    <button type="submit" class="form-control btn btn-primary btn-block">
                                        {{ __('Sign Up') }}
                                        <i class="mdi mdi-account-arrow-right mr-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="{{ asset('dashboard/js/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/js/popper.min.js') }}"></script>
<script src="{{ asset('dashboard/js/bootstrap.min.js') }}"></script>
<script src="//geodata.solutions/includes/countrystatecity.js"></script>
<script>
    $(document).on('click', '.btn-signin, .btn-signup', (e) => {
        $('.tab-pane').removeClass('active');

        if ($(e.currentTarget).is('.btn-signin')) {
            $('#signin').addClass('active');
        } else {
            $('#signup').addClass('active');
        }
    });
</script>
</body>
</html>