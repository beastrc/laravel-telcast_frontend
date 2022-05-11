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
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.dashboard.index'])) active active-menu @endif">
					<a href="{{ route('admin.dashboard.index') }}" class="iq-waves-effect">
						<i class="fas fa-tachometer-alt"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.genres.index'])) active active-menu @endif">
					<a href="{{ route('admin.genres.index') }}" class="iq-waves-effect">
						<i class="fas fa-stream fa-sm"></i>
						<span>Genres</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.languages.index'])) active active-menu @endif">
					<a href="{{ route('admin.languages.index') }}" class="iq-waves-effect">
						<i class="fas fa-globe-europe"></i>
						<span>Languages</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.media.index'])) active active-menu @endif">
					<a href="{{ route('admin.media.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Media</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.movies.index'])) active active-menu @endif">
					<a href="{{ route('admin.movies.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Movies</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.shows.index', 'admin.seasons.index', 'admin.episodes.index'])) active active-menu @endif">
					<a href="#shows" class="iq-waves-effect collapsed" data-toggle="collapse" aria-expanded="false">
						<i class="las la-list-ul"></i>
						<span>TV Shows</span>
						<i class="ri-arrow-right-s-line iq-arrow-right"></i>
					</a>
					<ul id="shows" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
						<li><a href="{{ route('admin.shows.index') }}"><i class="las la-user-plus"></i>Shows</a></li>
						<li><a href="{{ route('admin.seasons.index') }}"><i class="las la-user-plus"></i>Seasons</a></li>
						<li><a href="{{ route('admin.episodes.index') }}"><i class="las la-user-plus"></i>Episodes</a></li>
					</ul>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.live.index'])) active active-menu @endif">
					<a href="{{ route('admin.live.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Live</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.sports.index'])) active active-menu @endif">
					<a href="{{ route('admin.sports.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Sports</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.plans.index'])) active active-menu @endif">
					<a href="{{ route('admin.plans.index') }}" class="iq-waves-effect">
						<i class="fas fa-tags fa-sm"></i>
						<span>Subscription Plans</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.subscriptions.index'])) active active-menu @endif">
					<a href="{{ route('admin.subscriptions.index') }}" class="iq-waves-effect">
						<i class="fas fa-money-check-alt fa-sm"></i>
						<span>Subscriptions</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.transactions.index'])) active active-menu @endif">
					<a href="{{ route('admin.transactions.index') }}" class="iq-waves-effect">
						<i class="fas fa-random fa-sm"></i>
						<span>Transactions</span>
					</a>
				</li>
				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.users.index'])) active active-menu @endif">
					<a href="{{ route('admin.users.index') }}" class="iq-waves-effect">
						<i class="fas fa-users fa-sm"></i>
						<span>Users Management</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</div>