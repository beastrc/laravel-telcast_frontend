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
							Admin / <strong>Users</strong>
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
							<label class="form-label">{{ __('Name') }}</label>
							<input type="text" class="form-control" name="name" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Email') }}</label>
							<input type="email" class="form-control" name="email" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Password') }}</label>
							<input type="password" class="form-control" name="password" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Password Confirmation') }}</label>
							<input type="password" class="form-control" name="password_confirmation" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Send Verification Email') }}</label>
							<select class="form-control" name="send_verification_email" required>
								<option value="true" selected>Send Verification Email</option>
								<option value="false">Set as Verified</option>
							</select>
							<small class="form-text text-muted">
								<strong>TIP:</strong>
								Weather the Verification Email should be sent to the created user or set as verified?
							</small>
						</fieldset>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Create</button>
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
							<label class="form-label">{{ __('Name') }}</label>
							<input type="text" class="form-control" name="name" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Email') }}</label>
							<input type="email" class="form-control" name="email" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Password') }}</label>
							<input type="password" class="form-control" name="password">
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Password Confirmation') }}</label>
							<input type="password" class="form-control" name="password_confirmation">
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Send Verification Email') }}</label>
							<select class="form-control" name="send_verification_email">
								<option value="true" selected>Send Verification Email</option>
								<option value="false">Set as Verified</option>
							</select>
							<small class="form-text text-muted">
								<strong>TIP:</strong>
								Weather the Verification Email should be sent to the created user or set as verified?
							</small>
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
                    {title: 'NAME', data: 'name'},
                    {title: 'EMAIL', data: 'email'},
                    {title: 'EMAIL STATUS', data: 'email_verified_at'},
                    {title: 'ROLE', data: 'role'},
                    {title: 'STATUS', data: 'status'},
                    {title: 'CREATED AT', data: 'created_at'},
                    {title: 'ACTIONS', data: 'actions'},
                ],
                routes: {
                    index: "{{ route('admin.users.index') }}",
                    store: "{{ route('admin.users.store') }}",
                },
                callbacks: {
                    read: function (response, modal) {
                        if (response.status) {
                            console.log(modal, response);
                            modal.find('[name="name"]').val(response.data.name);
                            modal.find('[name="email"]').val(response.data.email);
                        }
                    }
                }
            });
        });
	</script>
@endsection