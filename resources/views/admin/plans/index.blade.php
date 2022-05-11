@extends('layouts.admin.app')

@section('page_css')
@endsection

@section('content')
	<div class="card border">
		<div class="card-body">
			<div class="container-fluid mx-0 mb-2">
				<div class="row align-items-center">
					<div class="col text-uppercase">
						<span class="tiny text-gray-600 Montserrat-font font-weight-semibold">
							Admin / <strong>Plans</strong>
						</span>
					</div>
					<div class="col text-right">
						<button class="btn btn-lg btn-primary rounded-sm" data-toggle="modal"
						        data-target="#create-modal">
							Create New
							<i class="fas fa-plus ml-1"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="card border">
		<div class="card-body">
			<div class="row">
				<div class="col-12">
					<table class="table datatables table-hover mb-0"></table>
				</div>
			</div>
		</div>
	</div>
	
	<!-- Create Modal -->
	<div class="modal fade" id="create-modal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form id="create-modal-form">
					<div class="modal-header">
						<h5 class="modal-title">Create Record</h5>
						<button class="btn btn-default btn-sm" data-dismiss="modal">
							<i class="fas fa-times fa-lg"></i>
						</button>
					</div>
					<div class="modal-body">
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Title') }}</label>
							<input type="text" class="form-control" name="title" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Price') }}</label>
							<input type="number" step="0.1" class="form-control" name="price" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Price Discount') }}</label>
							<input type="number" step="0.1" class="form-control" name="price_discount" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Price Annual') }}</label>
							<input type="number" step="0.1" class="form-control" name="price_annual" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Price Annual Discount') }}</label>
							<input type="number" step="0.1" class="form-control" name="price_annual_discount" required>
						</fieldset>
						
						<fieldset class="divider">
							<div class="divider-text">FEATURES</div>
						</fieldset>
						
						<fieldset class="form-group my-2">
							<label class="form-label">{{ __('Video Quality') }}</label>
							<select class="form-control" name="features[quality]" required>
								<option value="SD" selected>360p</option>
								<option value="HD">720p</option>
								<option value="FHD">1080p</option>
							</select>
							<small class="form-text text-muted">
								<strong>TIP:</strong> The maximum quality in which the video can be played
							</small>
						</fieldset>
						
						<fieldset class="form-group my-2">
							<label class="form-label">{{ __('Ad Free Entertainment') }}</label>
							<select class="form-control" name="features[ad_free_entertainment]" required>
								<option value="true" selected>Yes</option>
								<option value="false">No</option>
							</select>
						</fieldset>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Create
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Edit Modal -->
	<div class="modal fade" id="edit-modal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<form id="edit-modal-form">
					@method('PUT')
					
					<div class="modal-header">
						<h5 class="modal-title">Edit Record</h5>
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">
							<i class="fas fa-times fa-lg"></i>
						</button>
					</div>
					<div class="modal-body">
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Title') }}</label>
							<input type="text" class="form-control" name="title" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Price') }}</label>
							<input type="number" step="0.1" class="form-control" name="price" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Price Discount') }}</label>
							<input type="number" step="0.1" class="form-control" name="price_discount" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Price Annual') }}</label>
							<input type="number" step="0.1" class="form-control" name="price_annual" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Price Annual Discount') }}</label>
							<input type="number" step="0.1" class="form-control" name="price_annual_discount" required>
						</fieldset>
						
						<fieldset class="divider">
							<div class="divider-text">FEATURES</div>
						</fieldset>
						
						<fieldset class="form-group my-2">
							<label class="form-label">{{ __('Video Quality') }}</label>
							<select class="form-control" name="features[quality]" required>
								<option value="SD">360p</option>
								<option value="HD">720p</option>
								<option value="FHD">1080p</option>
							</select>
							<small class="form-text text-muted">
								<strong>TIP:</strong> The maximum quality in which the video can be played
							</small>
						</fieldset>
						
						<fieldset class="form-group my-2">
							<label class="form-label">{{ __('Ad Free Entertainment') }}</label>
							<select class="form-control" name="features[ad_free_entertainment]" required>
								<option value="true">Yes</option>
								<option value="false">No</option>
							</select>
						</fieldset>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary"><i class="fas fa-check mr-1"></i>Update
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script>
        $(window).on('load', function () {
            new Crud({
                columns: [
                    {title: 'TITLE', data: 'title'},
                    {title: 'PRICE', data: 'price'},
                    {title: 'PRICE DISCOUNT', data: 'price_discount'},
                    {title: 'PRICE ANNUAL', data: 'price_annual'},
                    {title: 'PRICE ANNUAL DISCOUNT', data: 'price_annual_discount'},
                    {title: 'FEATURES', data: 'features'},
                    {title: 'STATUS', data: 'status'},
                    {title: 'CREATED AT', data: 'created_at'},
                    {title: 'ACTIONS', data: 'actions'},
                ],
                routes: {
                    index: "{{ route('admin.plans.index') }}",
                    store: "{{ route('admin.plans.store') }}",
                },
                callbacks: {
                    read: function (response, modal) {
                        if (response.status) {
                            console.log(modal, response);
                            modal.find('[name="title"]').val(response.data.title);
                            modal.find('[name="price"]').val(response.data.price);
                            modal.find('[name="price_discount"]').val(response.data.price_discount);
                            modal.find('[name="price_annual"]').val(response.data.price_annual);
                            modal.find('[name="price_annual_discount"]').val(response.data.price_annual_discount);
                            modal.find('[name="features[quality]"]').val(response.data.features.quality);
                            modal.find('[name="features[ad_free_entertainment]"]').val(response.data.features.ad_free_entertainment);
                        }
                    }
                }
            });
        });
	</script>
@endsection