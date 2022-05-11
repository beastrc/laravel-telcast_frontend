@extends('layouts.admin.app')

@section('page_css')
@endsection

@section('content')
	<div class="card border">
		<div class="card-body">
			<div class="row">
				<div class="col-12">
					<table class="table datatables table-hover mb-0"></table>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script>
        $(window).on('load', function () {
            new Crud({
                columns: [
                    {title: 'USER', data: 'user'},
                    {title: 'PLAN', data: 'plan'},
                    {title: 'TXN ID', data: 'txn_id'},
                    {title: 'AMOUNT', data: 'amount'},
                    {title: 'CURRENCY', data: 'currency'},
                    {title: 'METHOD', data: 'method'},
                    {title: 'PERIOD', data: 'period'},
	                {title: 'STATUS', data: 'status'},
                    {title: 'CREATED AT', data: 'created_at'},
                    {title: 'ACTIONS', data: 'actions'},
                ],
                routes: {
                    index: "{{ route('admin.transactions.index') }}",
                },
            });
        });
	</script>
@endsection