@extends('layouts.user.app')

@section('page_css')
@endsection

@section('content')
	<div class="row mb-4">
		<div class="col-12">
			<div class="bg-dark d-flex justify-content-center" style="height: 180px;">
				<span class="my-auto">Ad banner</span>
			</div>
		</div>
	</div>

	<div class="row mb-4">
		<div class="col-12">
			<div class="card">
				<div class="card-header border">My Subscriptions</div>
				<div class="card-body border border-top-0">
					<table class="table datatables table-hover mb-0"></table>
				</div>
			</div>
		</div>
	</div>

	<div class="row mb-4">
		<div class="col-12">
			<div class="card">
				<div class="card-header border">Recommended Channels</div>
				<div class="card-body border border-top-0">
					<table class="table datatables-channels table-hover mb-0"></table>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script>
		new Crud({
			columns: [
				{title: 'CHANNEL', data: 'channel'},
				{title: 'PRICE', data: 'price'},
				{title: 'NEXT BILLING DATE', data: 'expired_at'},
				{title: 'STATUS', data: 'status'},
				{title: 'ACTIONS', data: 'actions'},
			],
			routes: {
				index: "{{ route('user.subscriptions.index') }}",
			},
		});

		new Crud({
			datatables: '.datatables-channels',
			columns: [
				{title: 'CHANNEL', data: 'channel'},
				{title: 'PRICE(without ads)', data: 'subscription_price_without_ads'},
				{title: 'PRICE(with ads)', data: 'subscription_price_with_ads'},
				{title: 'ACTIONS', data: 'actions'},
			],
			data: {
				type: 'channels'
			},
			routes: {
				index: "{{ route('user.subscriptions.index') }}",
			},
		});
	</script>
@endsection