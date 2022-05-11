@extends('layouts.advertiser.campaign.app')
@section('content')
	<!-- contacts -->
	<section class="section">
		<div class="container">
			<div class="row">
				<div class="col-12 col-md-7 col-lg-8">
					<div class="row">
						<!-- section title -->
						<div class="col-12">
							<h1 class="section_title">Welcome to Telcast to Ads</h1>
						</div>
						<!-- end section title -->

						<div class="col-12">
							<div class="title">
								<p>Get in front of customers when they’re searching for businesses like yours on Google Search and Maps. Only pay for results, like clicks to your website or calls to your business.</p>
<!-- 								<div class="row">
									<div class="col-lg-5 col-md-12 col-12">
 -->										<!-- 4 -->
<!-- 										<a type="button" class="form__btn beast_login_btn" href="{{ route('login') }}?purpose=2">Create a campaign</a> -->
						                @auth
											<!-- <a type="button" class="form__btn beast_login_btn" href="{{ route('createcampaign') }}">Create a campaign 11</a> -->
						                @else
											<!-- <a type="button" class="form__btn beast_login_btn" href="{{ route('login') }}">Create a campaign 22</a> -->
						                @endauth
<!-- 									</div>
									<div  class="col-lg-5 col-md-12 col-12"> -->
										<!-- 1 -->
<!-- 										<a type="button" class="form__btn beast_register_btn" href="{{ route('login') }}">View Campaign</a>
									</div>
								</div> -->
								<div class="row button_panel">
					                @auth
						                <div class="col-lg-5 col-md-12 col-12">
											<a type="button" class="form__btn beast_login_btn" href="{{ route('createcampaign') }}">Create a campaign</a>
						                </div>
						                <div class="col-lg-5 col-md-12 col-12">
											<a type="button" class="form__btn beast_register_btn" href="{{ route('advertiser/dashboard') }}">View Campaign</a>
						                </div>
									@else
						                <div class="col-lg-5 col-md-12 col-12">
											<a type="button" class="form__btn beast_login_btn" href="{{ route('gologinpage', 2) }}">Create a campaign</a>						                	
						                </div>
						                <div class="col-lg-5 col-md-12 col-12">
											<a type="button" class="form__btn beast_register_btn" href="{{ route('gologinpage', 3) }}">View a campaign</a>
						                </div>
									@endauth
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>
	<!-- end contacts -->
@endsection
