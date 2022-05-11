<!DOCTYPE html>
<html>
<head>
	<title>Telcast</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/hcc_login.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" href="{{ asset('images/logo_icon.png') }}" >

<script type="text/javascript">
    	$(document).ready(function(){
    		$('.log-btn').on('click', function(){
    			$('#signup-title').show();
    			$('#login').show();
    			$('#signup-page').hide();
    			$('#demo').hide();
    			$('#have').show();
    		});
    		$('.log-btn1').on('click', function(){
    			$('#demo').show();
    			$('#signup-page').show();
    			$('#signup-title').hide();
    			$('#login').hide();
    			$('#already').show();
    		});
		});
    </script>
</head>
<body>
    <section class="section_height">
        <div class="container-fluid">
            <div class="row container-fluid">
                <div class="col-md-5 col-sm-12 row" id="login" style="display: none;">
                    <div class="col-md-8 col-sm-12 w3-container w3-center w3-animate-top my-auto mx-auto">
                        <form method="POST" action="{{ route('loginaction', 3) }}" class="signin-form">
                        <h2 style="color:white; margin-bottom:20px;">Welcome to Sign In</h2>
                        @csrf
                            <div class="form-group">
                                <label style="color:white;" >{{ __('Email') }}</label>
                                <input class="form-control mb-0" type="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus/>
                            </div>
                            <div class="form-group">
                                <label style="color:white;" >{{ __('Password') }}</label>
                                <input class="form-control mb-0" type="password" name="password" placeholder="Enter your password" required autocomplete="current-password"/>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50 text-left">
                                    <div class="custom-control d-flex align-items-center">
                                        <input type="checkbox" class="custom-control-input" name="remember" id="remember">
                                        <label class="custom-control-label" for="remember" style="color:white; line-height: 25px;">{{ __('Remember me') }}</label>
                                    </div>
                                </div>
                                <div class="w-50 text-md-right" >
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" style="color: white; text-decoration: none;">{{ __('Forgot your password?') }}</a>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group" style="margin-top:20px;">
                                <button type="submit" class="form-control">
                                    {{ __('Sign In') }}
                                    <i class="mdi mdi-login-variant mr-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-2 column" style="height: 100%; display: none;">
                    <span class="vertical-line" id="v-line"></span>
                    <!-- <p class="test1" id="tel">Telcast</p> -->
                    <span class="vertical-line" id="v-line1"></span>
                </div>
                <div class="col-md-5 row" id="demo">
                    <div class="col-12 text-center w3-animate-bottom my-auto">
                        <button class="log-btn">LOGIN</button>
                        <p id="already" class="already-p">Aleady have an account?</p>
                    </div>
                </div>
                <div class="col-md-2 d-flex flex-column telcast_line">
                        <span class="vertical-line mx-auto" id="verb"></span>
                        <p class="test1 mx-auto text-center" id="verb1">Telcast</p>
                        <span class="vertical-line mx-auto" id="verb2"></span>
                    </div>
                <div class="col-md-5 text-center w3-animate-bottom my-auto" id="signup-title">
                    <button class="log-btn1">SIGNUP</button>
                    <p id="have" class="already-p1">Don't have an account?</p>
                </div>
                <div class="col-md-5 col-sm-12 w3-container w3-center w3-animate-top" style="display: none;" id="signup-page">
                    <div class="inner-signup mx-auto">
                        <h3>Sign Up</h3>
                        <form method="POST" action="{{ route('register') }}" class="signin-form">
                            @csrf

                            <div class="row">
                                <div class="col form-group">
                                    <label>{{ __('First Name') }}</label>
                                    <input class="form-control mb-0" type="text" name="firstname"
                                            placeholder="Enter your First Name"
                                            value="{{ old('firstname') }}" required autofocus
                                            autocomplete="firstname"/>
                                </div>

                                <div class="col form-group">
                                    <label>{{ __('Last Name') }}</label>
                                    <input class="form-control mb-0" type="text" name="lastname"
                                            placeholder="Enter your Last Name"
                                            value="{{ old('lastname') }}" required autofocus
                                            autocomplete="lastname"/>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label>{{ __('Country') }}</label>
                                    <select class="countries form-control mb-0" name="country" id="countryId"
                                            required>
                                        <option value="">Select Country</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label>{{ __('State') }}</label>
                                    <select class="states form-control mb-0" name="state" id="stateId" required>
                                        <option value="">Select State</option>
                                    </select>
                                </div>

                                <div class="col form-group">
                                    <label>{{ __('City') }}</label>
                                    <select class="cities form-control mb-0" name="city" id="cityId" required>
                                        <option value="">Select City</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label>{{ __('Email') }}</label>
                                    <input class="form-control mb-0" type="email" name="email"
                                            placeholder="Enter your email"
                                            value="{{ old('email') }}" required autofocus
                                            autocomplete="email"/>
                                </div>
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
                                <div class="col form-group">
                                    <label>{{ __('Gender') }}</label>
                                    <select class="form-control mb-0" name="gender" required>
                                        <option value="">Select Gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="others">Others</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col form-group">
                                    <label>{{ __('Date of Birth') }}</label>
                                    <input type="date" class="form-control mb-0" name="date_of_birth" required>
                                </div>
                            </div>

                            <!-- <div class="row mb-3">
                                <div class="col form-group">
                                    <label>{{ __('Purpose of Joining') }}</label>
                                    <select class="form-control mb-0" name="role" required>
                                        <option value="">Select Purpose of Joining</option>
                                        <option value="channel" @if(request()->has('purpose') && request()->input('purpose') == 1) selected @endif>Super</option>
                                        <option value="channel" @if(request()->has('purpose') && request()->input('purpose') == 2) selected @endif>User</option> -->

                                        <!-- <option value="advertiser" @if(request()->has('purpose') && request()->input('purpose') == 1) selected @endif>Advertisement</option>
                                        <option value="channel" @if(request()->has('purpose') && request()->input('purpose') == 2) selected @endif>Starting a New Channel</option>
                                        <option value="user" @if(request()->has('purpose') && request()->input('purpose') == 3) selected @endif>Just for Watching Contents</option>
                                        <option value="user" @if(request()->has('purpose') && request()->input('purpose') == 4) selected @endif>Just for Campaign</option> -->
                                    <!-- </select>
                                </div>
                            </div> -->

                            <div class="sign-info">
                                <button type="submit" class="form-control">
                                    {{ __('Sign Up') }}
                                    <i class="mdi mdi-account-arrow-right mr-2"></i>
                                </button>
                            </div>
                        </form>
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
