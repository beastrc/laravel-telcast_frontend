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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border d-flex justify-content-between align-items-center">
                    <span style="font-size: 16px;">Payment Methods</span>
                    <a href="{{ route('user.payment-methods.create') }}" class="btn btn-primary rounded-sm">
                        Add New
                        <i class="fas fa-plus-circle ml-1"></i>
                    </a>
                </div>
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
                    {title: 'CARD HOLDER', data: 'pm_holder'},
                    {title: 'LAST 4', data: 'pm_last_four'},
                    {title: 'IS DEFAULT', data: 'pm_default'},
                    {title: 'CREATED AT', data: 'created_at'},
                    {title: 'ACTIONS', data: 'actions'},
                ],
                routes: {
                    index: "{{ route('user.payment-methods.index') }}",
                },
            });
        });
	</script>
@endsection