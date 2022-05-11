<div class="iq-sidebar border-right">
	<div class="iq-sidebar-logo d-flex justify-content-between">
		<a href="{{ route('frontend.home') }}" class="header-logo">
			<img src="{{ asset('dashboard/images/logo-full.png') }}" class="img-fluid rounded-normal">
		</a>
		<div class="iq-menu-bt-sidebar d-md-none">
			<div class="iq-menu-bt align-self-center">
				<div class="wrapper-menu">
					<div class="main-circle"><i class="las la-bars"></i></div>
				</div>
			</div>
		</div>
	</div>
	<div id="sidebar-scrollbar">
		<nav class="iq-sidebar-menu">
			<ul id="iq-sidebar-toggle" class="iq-menu">
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['network.dashboard.index'])) active active-menu @endif">
					<a href="{{ route('network.dashboard.index') }}" class="iq-waves-effect">
						<i class="fas fa-tachometer-alt"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['network.channels.index'])) active active-menu @endif">
					<a href="{{ route('network.channels.index') }}" class="iq-waves-effect">
						<i class="fas fa-tv"></i>
						<span>Channels</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['network.operators.index'])) active active-menu @endif">
					<a href="{{ route('network.operators.index') }}" class="iq-waves-effect">
						<i class="fas fa-users"></i>
						<span>Channel Operators</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</div>