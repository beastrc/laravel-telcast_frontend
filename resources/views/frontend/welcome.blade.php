<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Themesdesign">
    <meta name="description" content="Premium Bootstrap 4 Landing Page Template">
    <meta name="keywords" content="bootstrap 4, premium, marketing, multipurpose">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" href="{{ asset('frontend/images/favicon.ico') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Stint+Ultra+Expanded&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Six+Caps&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('css/welccome.css') }}" /> 
    <link rel="icon" href="{{ asset('images/logo_icon.png') }}" >

</head>
<body>
<div class="wrapper">
    <header class="container d-flex align-items-center">
        <div class="left">
            <a href="{{ url('gohome') }}"><img src="{{ asset('frontend/images/logo-full.png') }}" class="logo-light" alt="" height="24"></a>
        </div>
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="" style="background-color: transparent; color:white; border: 0px solid transparent;">
                        {{ __('Logout') }}
                    </button>
                </form>
                    <!-- <a href="{{ url('/logout') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Logout</a> -->
                @else
                    <a href="{{ route('gologinpage', 0)}}" class="me-4 text-uppercase">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('login') }}?purpose=2" class="text-uppercase">Register</a>
                    @endif
                @endauth
            </div>
        @endif
        <!-- <div class="right">
            <a href="{{ route('login') }}" class="me-4 text-uppercase">Login</a>
            <a href="{{ route('login') }}?purpose=2" class="text-uppercase">Register</a>
        </div> -->
    </header>
    <main class="container d-flex flex-column justify-content-between pb-5 pb-lg-4"  style="height: calc(100% - 70px);">
        <div class="mx-1 d-flex align-items-center" style="height: 50px" id="first_panel_1">
            <a href="{{ route('gocampaign') }}" class="d-flex me-4 align-items-center">
                <i class="fas fa-bullseye fa-lg me-2"></i> Start Advertising
            </button>

            @auth
                <a href="{{ route('channel/dashboard') }}" class="d-flex align-items-center">
                    <i class="fas fa-network-wired fa-lg me-2"></i> Start a Channel
                </a>
            @else
            <!-- <a href="{{ route('login') }}?purpose=2" class="d-flex align-items-center"> -->

            <a href="{{ route('gologinpage', 1) }}" class="d-flex align-items-center">
                    <i class="fas fa-network-wired fa-lg me-2"></i> Start a Channel
                </a>
            @endauth

<!--             <a href="{{ route('login') }}?purpose=2" class="d-flex align-items-center">
                <i class="fas fa-network-wired fa-lg me-2"></i> Start a Channel
            </a> -->

        </div>
        <div class="middle row justify-content-center align-items-center mb-4" id="first_panel_2">
            <div class="col-12 col-lg-4 text-center mb-4">
                <img src="{{ asset('images/logo_icon.png') }}" class="img-fluid logo-width">
            </div>
            <div class="col-12 col-lg-8 text-center text-lg-start">
                <img src="{{ asset('images/telcast_text_home.svg') }}" class="mx-auto" width="100%">
            </div>
        </div>
        <div class="mx-1 d-flex align-items-center" style="height: 50px" id="first_panel_3">
        <!-- 3 -->
            <a href="{{ route('login') }}?purpose=2" class="me-4 d-flex align-items-center">
                <i class="fas fa-play-circle fa-3x me-2 " id="beast_start_watching" ></i> <span style="font-size:20px;">Start Watching</span>
                <!-- text-warning c-ripple rounded-circle -->
            </a>
        </div>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // document.getElementById('beast_start_watching').classList.addclass = "text-warning";
</script>
</body>
</html>