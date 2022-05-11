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
                <div class="card-header border">Transactions</div>
                <div class="card-body border border-top-0">
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
                    {title: 'CHANNEL', data: 'channel'},
                    {title: 'TXN ID', data: 'txn_id'},
                    {title: 'AMOUNT', data: 'amount'},
                    {title: 'CURRENCY', data: 'currency'},
                    {title: 'METHOD', data: 'method'},
	                {title: 'STATUS', data: 'status'},
                    {title: 'CREATED AT', data: 'created_at'},
                    {title: 'ACTIONS', data: 'actions'},
                ],
                routes: {
                    index: "{{ route('user.transactions.index') }}",
                },
            });
        });
	</script>
@endsection