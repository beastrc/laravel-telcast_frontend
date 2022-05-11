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
				<li class="@if(isCurrentRoute('user.dashboard.index')) active active-menu @endif">
					<a href="{{ route('user.dashboard.index') }}" class="iq-waves-effect">
						<i class="fas fa-home"></i>
						<span>Dashboard</span>
					</a>
				</li>
				<li class="@if(isCurrentRoute('user.payment-methods.index')) active active-menu @endif">
					<a href="{{ route('user.payment-methods.index') }}" class="iq-waves-effect">
						<i class="fas fa-credit-card"></i>
						<span>Payment Methods</span>
					</a>
				</li>
				<li class="@if(isCurrentRoute('user.subscriptions.index')) active active-menu @endif">
					<a href="{{ route('user.subscriptions.index') }}" class="iq-waves-effect">
						<i class="fas fa-dot-circle"></i>
						<span>Subscriptions</span>
					</a>
				</li>
				<li class="@if(isCurrentRoute('user.transactions.index')) active active-menu @endif">
					<a href="{{ route('user.transactions.index') }}" class="iq-waves-effect">
						<i class="fas fa-random"></i>
						<span>Transactions</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</div>