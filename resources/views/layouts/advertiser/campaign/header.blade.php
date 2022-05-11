<header class="container d-flex align-items-center">
    <div class="col-10">
        <a href="{{ url('gohome') }}"><img src="{{ asset('frontend/images/logo-full.png') }}" class="logo-light" alt="" height="24"></a>
    </div>
    <div class="col-2">
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
                    <a href="{{ route('login') }}" class="me-4 text-uppercase campaign_a">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('login') }}" class="text-uppercase ">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</header>

