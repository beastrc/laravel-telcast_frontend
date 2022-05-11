@extends('layouts.channel.app')

@section('page_css')
	<style>
        .table img {
            height: 50px;
        }
	</style>
@endsection

@section('content')
	<div class="card border">
		<div class="card-header d-flex justify-content-between align-items-center">
			<div class="font-weight-bold" style="font-size: 16px;">LANGUAGES</div>
			<div>
				<button class="btn btn-primary rounded-sm" data-toggle="modal" data-target="#create-modal">
					Create New
					<i class="fas fa-plus ml-1"></i>
				</button>
			</div>
		</div>
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
						<div class="mb-3">
							<label class="form-label">{{ __('Title') }}</label>
							<input type="text" class="form-control" name="title" required>
						</div>
						
						<div class="mb-3">
							<label class="form-label">{{ __('Description') }}</label>
							<textarea class="form-control" rows="5" name="description" required></textarea>
						</div>
						
						<div class="mb-3">
							<label class="form-label">{{ __('Thumbnail') }}</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="thumbnail" id="thumbnail"
								       accept="image/jpeg,image/jpg,image/png,image/svg">
								<label class="custom-file-label" for="thumbnail">Choose file</label>
							</div>
							<div class="text-muted small mt-2">
								<i class="fas fa-info-circle mr-1"></i>
								Image size must be <code>300px(width) * 168px(height)</code>
							</div>
						</div>
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
						<div class="mb-3">
							<label class="form-label">{{ __('Title') }}</label>
							<input type="text" class="form-control" name="title" required>
						</div>
						
						<div class="mb-3">
							<label class="form-label">{{ __('Description') }}</label>
							<textarea class="form-control" rows="5" name="description" required></textarea>
						</div>
						
						<div class="mb-3">
							<label class="form-label">{{ __('Thumbnail') }}</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="thumbnail" id="thumbnail"
								       accept="image/jpeg,image/jpg,image/png,image/svg">
								<label class="custom-file-label" for="thumbnail">Choose file</label>
							</div>
							<div class="text-muted small mt-2">
								<i class="fas fa-info-circle mr-1"></i>
								Image size must be <code>300px(width) * 168px(height)</code>
							</div>
						</div>
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
                    {title: 'THUMBNAIL', data: 'thumbnail'},
                    {title: 'TITLE', data: 'title'},
                    {title: 'DESCRIPTION', data: 'description'},
                    {title: 'STATUS', data: 'status'},
                    {title: 'CREATED AT', data: 'created_at'},
                    {title: 'ACTIONS', data: 'actions'},
                ],
                routes: {
                    index: "{{ route('channel.languages.index') }}",
                    store: "{{ route('channel.languages.store') }}",
                },
                callbacks: {
                    read: function (response, modal) {
                        if (response.status) {
                            modal.find('[name="title"]').val(response.data.title);
                            modal.find('[name="description"]').val(response.data.description);
                        }
                    }
                }
            });
        });
	</script>
@endsection