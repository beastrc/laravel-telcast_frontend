@extends('layouts.auth.app')

@section('content')
	<section class="sign-in-page">
		<div class="container">
			<div class="row justify-content-center align-items-center height-self-center">
				<div class="col-lg-7 col-md-12 align-self-center">
					<div class="sign-user_card">
						<div class="sign-in-page-data">
							<div class="sign-in-from w-100 m-auto">
								<h3 class="mb-3 text-center">{{ __('Sign Up') }}</h3>
								
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
								
								<form method="POST" action="{{ route('register') }}" data-toggle="validator"
								      class="mt-4">
									@csrf
									
									<div class="row">
										<div class="col form-group">
											<label>{{ __('Name') }}</label>
											<input class="form-control mb-0" type="text" name="name"
											       value="{{ old('name') }}" required autofocus autocomplete="name"/>
										</div>
										
										<div class="col form-group">
											<label>{{ __('Email') }}</label>
											<input class="form-control mb-0" type="email" name="email"
											       value="{{ old('email') }}" required/>
										</div>
									</div>
									
									<div class="row mb-3">
										<div class="col form-group">
											<label>{{ __('Password') }}</label>
											<input class="form-control mb-0" type="password" name="password" required
											       autocomplete="new-password"/>
										</div>
										
										<div class="col form-group">
											<label>{{ __('Confirm Password') }}</label>
											<input class="form-control mb-0" type="password"
											       name="password_confirmation" required autocomplete="new-password"/>
										</div>
									</div>
         
									<div class="sign-info">
										<button type="submit" class="btn btn-primary">{{ __('Register') }}</button>
									</div>
								</form>
							</div>
						</div>
						<div class="mt-3">
							<div class="d-flex justify-content-center links">
								Already have an account? <a href="{{ route('login') }}"
								                            class="text-primary ml-2">{{ __('Login') }}</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
