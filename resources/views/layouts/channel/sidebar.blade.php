<style>
	.sidebar-divider span{
		padding: 15px 20px;
		font-size: 12px;
		color: #a6a4b0;
		line-height: 1.5;
		letter-spacing: 0.1rem;
		font-weight: 500;
	}
</style>
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
				<li class="@if(isCurrentRoute('channel.dashboard.index')) active active-menu @endif">
					<a href="{{ route('channel.dashboard.index') }}" class="iq-waves-effect">
						<i class="fas fa-tachometer-alt"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="sidebar-divider"><span>GENRES & LANGUAGES</span></li>
				<li class="@if(isCurrentRoute('channel.genres.index')) active active-menu @endif">
					<a href="{{ route('channel.genres.index') }}" class="iq-waves-effect">
						<i class="fas fa-stream fa-sm"></i>
						<span>Genres</span>
					</a>
				</li>
				<li class="@if(isCurrentRoute('channel.languages.index')) active active-menu @endif">
					<a href="{{ route('channel.languages.index') }}" class="iq-waves-effect">
						<i class="fas fa-globe-europe"></i>
						<span>Languages</span>
					</a>
				</li>
				<li class="sidebar-divider"><span>MEDIA LIBRARY</span></li>
				<li class="@if(isCurrentRoute('channel.media.index')) active active-menu @endif">
					<a href="{{ route('channel.media.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Media</span>
					</a>
				</li>
				<li class="sidebar-divider"><span>SPOTLIGHTS</span></li>
				<li class="@if(isCurrentRoute('channel.spotlights.index')) active active-menu @endif">
					<a href="{{ route('channel.spotlights.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Spotlights</span>
					</a>
				</li>
				<li class="sidebar-divider"><span>SEGMENTS</span></li>
				<li class="@if(isCurrentRoute('channel.movies.index')) active active-menu @endif">
					<a href="{{ route('channel.movies.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Movies</span>
					</a>
				</li>
				<li class="@if(isCurrentRoute('channel.shows.index')) active active-menu @endif">
					<a href="{{ route('channel.shows.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Shows</span>
					</a>
				</li>
				<li class="@if(isCurrentRoute('channel.seasons.index')) active active-menu @endif">
					<a href="{{ route('channel.seasons.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Seasons</span>
					</a>
				</li>
				<li class="@if(isCurrentRoute('channel.episodes.index')) active active-menu @endif">
					<a href="{{ route('channel.episodes.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Episodes</span>
					</a>
				</li>
				<li class="@if(isCurrentRoute('channel.live.index')) active active-menu @endif">
					<a href="{{ route('channel.live.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Live</span>
					</a>
				</li>
				<li class="@if(isCurrentRoute('channel.sports.index')) active active-menu @endif">
					<a href="{{ route('channel.sports.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Sports</span>
					</a>
				</li>
				<li class="sidebar-divider"><span>ANALYTICS</span></li>
				<li class="@if(isCurrentRoute('channel.subscription-analytics.index')) active active-menu @endif">
					<a href="{{ route('channel.subscription-analytics.index') }}" class="iq-waves-effect">
						<i class="fas fa-play-circle"></i>
						<span>Subscription Analytics</span>
					</a>
				</li>
				{{--				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['channel.subscriptions.index'])) active active-menu @endif">--}}
{{--					<a href="{{ route('channel.subscriptions.index') }}" class="iq-waves-effect">--}}
{{--						<i class="fas fa-money-check-alt fa-sm"></i>--}}
{{--						<span>Subscription Analytics</span>--}}
{{--					</a>--}}
{{--				</li>--}}
{{--				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['channel.subscriptions.index'])) active active-menu @endif">--}}
{{--					<a href="{{ route('channel.subscriptions.index') }}" class="iq-waves-effect">--}}
{{--						<i class="fas fa-money-check-alt fa-sm"></i>--}}
{{--						<span>Subscriptions</span>--}}
{{--					</a>--}}
{{--				</li>--}}
{{--				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['channel.transactions.index'])) active active-menu @endif">--}}
{{--					<a href="{{ route('channel.transactions.index') }}" class="iq-waves-effect">--}}
{{--						<i class="fas fa-random fa-sm"></i>--}}
{{--						<span>Transactions</span>--}}
{{--					</a>--}}
{{--				</li>--}}
{{--				<li class="@if(in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['channel.users.index'])) active active-menu @endif">--}}
{{--					<a href="{{ route('channel.users.index') }}" class="iq-waves-effect">--}}
{{--						<i class="fas fa-users fa-sm"></i>--}}
{{--						<span>Users Management</span>--}}
{{--					</a>--}}
{{--				</li>--}}
			</ul>
		</nav>
	</div>
</div>