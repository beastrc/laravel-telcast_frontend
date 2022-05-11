@extends('layouts.user.app')

@section('page_css')
	<style>
        .rounded-lg {
            border-radius: 1rem !important;
        }

        .text-small {
            font-size: 0.9rem !important;
        }

        .custom-separator {
            width: 5rem;
            height: 6px;
            border-radius: 1rem;
        }

        .text-uppercase {
            letter-spacing: 0.2em;
        }

        section i {
            width: 20px;
        }
	</style>
@endsection

@section('content')
	<section class="container py-5">
		<header class="text-center mb-5 text-white">
			<div class="row">
				<div class="col-lg-7 mx-auto">
					<h1>Subscription Plans</h1>
					<p>{{ env('app_name') }} offers a variety of plans to meet your needs. Subscribe to a plan or
					                         upgrade to get more benefits of watching movies, shows and streaming live
					                         videos.</p>
				</div>
			</div>
		</header>
		
		@if(session()->has('success'))
			<div class="alert alert-success">{{ session()->get('success') }}</div>
		@elseif(session()->has('warning'))
			<div class="alert alert-warning">{{ session()->get('warning') }}</div>
		@elseif(session()->has('errir'))
			<div class="alert alert-danger">{{ session()->get('error') }}</div>
		@endif
		
		<ul class="nav nav-pills mb-3 border rounded-pill p-1 justify-content-between" id="plans-nav">
			<li class="nav-item my-auto pl-3 font-weight-bold">Plans Period</li>
			<li class="nav-item ml-auto mr-1">
				<a class="nav-link rounded-pill active" id="plans-monthly-tab" data-toggle="pill"
				   href="#plans-monthly">Monthly</a>
			</li>
			<li class="nav-item">
				<a class="nav-link rounded-pill" id="plans-yearly-tab" data-toggle="pill"
				   href="#plans-yearly">Yearly</a>
			</li>
		</ul>
		
		<div class="tab-content">
			<div class="tab-pane fade show active" id="plans-monthly">
				<div class="row text-center align-items-end">
					@if(isset($plans) && $plans->isNotEmpty())
						@foreach($plans as $plan)
							<div class="col-lg-4 mb-5 mb-lg-0">
								<div class="py-5 rounded-lg shadow-sm border">
									<section class="head">
										<h1 class="h6 text-uppercase font-weight-bold mb-4">{{ $plan->title }}</h1>
										<h2 class="h1 font-weight-bold">
											${{ $plan->price }}
											<span class="text-small font-weight-normal">/ month</span>
										</h2>
										<h3 class="font-weight-bold">
											<del>${{ $plan->price_discount }}</del>
										</h3>
									</section>
									<div class="custom-separator my-4 mx-auto bg-primary"></div>
									<section class="body px-5">
										<ul class="list-unstyled my-5 text-small text-left">
											@foreach($plan->features as $feature => $value)
												@switch($feature)
													@case('quality')
													<li class="mb-3">
														<i class="fa fa-check mr-2 text-primary"></i>
														Video Quality <strong>{{ $value }}</strong>
													</li>
													@break
													
													@case('ad_free_entertainment')
													@switch($value)
														@case(true)
														<li class="mb-3">
															<i class="fa fa-check mr-2 text-primary"></i>
															<strong>Ad Free Entertainment</strong>
														</li>
														@break
														
														@case(false)
														<li class="mb-3 text-muted">
															<i class="fa fa-times mr-2"></i>
															<del>Ad Free Entertainment</del>
														</li>
														@break
													@endswitch
													@break
												@endswitch
											@endforeach
										</ul>
										<form action="{{ route('user.plans.subscribe', [$plan->id, 'monthly']) }}"
										      method="POST">
											@csrf
											<button type="submit"
											        class="btn btn-primary btn-block p-2 shadow rounded-pill">Subscribe
											</button>
										</form>
									</section>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
			<div class="tab-pane fade" id="plans-yearly">
				<div class="row text-center align-items-end">
					@if(isset($plans) && $plans->isNotEmpty())
						@foreach($plans as $plan)
							<div class="col-lg-4 mb-5 mb-lg-0">
								<div class="py-5 rounded-lg shadow-sm border">
									<section class="head">
										<h1 class="h6 text-uppercase font-weight-bold mb-4">{{ $plan->title }}</h1>
										<h2 class="h1 font-weight-bold">
											${{ $plan->price_annual }}
											<span class="text-small font-weight-normal">/ month</span>
										</h2>
										<h3 class="font-weight-bold">
											<del>${{ $plan->price_annual_discount }}</del>
										</h3>
									</section>
									<div class="custom-separator my-4 mx-auto bg-primary"></div>
									<section class="body px-5">
										<ul class="list-unstyled my-5 text-small text-left">
											@foreach($plan->features as $feature => $value)
												@switch($feature)
													@case('quality')
													<li class="mb-3">
														<i class="fa fa-check mr-2 text-primary"></i>
														Video Quality <strong>{{ $value }}</strong>
													</li>
													@break
													
													@case('ad_free_entertainment')
													@switch($value)
														@case('true')
														<li class="mb-3">
															<i class="fa fa-check mr-2 text-primary"></i>
															<strong>Ad Free Entertainment</strong>
														</li>
														@break
														
														@case('false')
														<li class="mb-3 text-muted">
															<i class="fa fa-times mr-2"></i>
															<del>Ad Free Entertainment</del>
														</li>
														@break
													@endswitch
													@break
												@endswitch
											@endforeach
										</ul>
										<form action="{{ route('user.plans.subscribe', [$plan->id, 'yearly']) }}"
										      method="POST">
											@csrf
											
											<button type="submit"
											        class="btn btn-primary btn-block p-2 shadow rounded-pill">Subscribe
											</button>
										</form>
									</section>
								</div>
							</div>
						@endforeach
					@endif
				</div>
			</div>
		</div>
	</section>
@endsection

@section('page_js')
@endsection