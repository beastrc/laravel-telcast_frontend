@extends('layouts.network.app')

@section('page_css')
@endsection

@section('content')
	<div class="card border">
		<div class="card-header d-flex justify-content-between align-items-center">
			<div class="font-weight-bold" style="font-size: 16px;">CHANNELS</div>
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
	
	<!-- CREATE MODAL -->
	<div class="modal fade" id="create-modal">
		<div class="modal-dialog modal-lg modal-dialog-centered">
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
							<label class="form-label">{{ __('Category') }}</label>
							<select class="form-control select-select2 category" name="category_id" required></select>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Title') }}</label>
							<input type="text" class="form-control" name="title" placeholder="Type in the network title/name" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Logo') }}</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="logo" id="logo" required>
								<label class="custom-file-label" for="logo">Choose Logo</label>
							</div>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Background') }}</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="background" id="background" required>
								<label class="custom-file-label" for="background">Choose Background</label>
							</div>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Description') }}</label>
							<textarea class="form-control" rows="5" name="description" placeholder="Type in a few lines of description" required></textarea>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Phone') }}</label>
							<input type="text" class="form-control" name="phone" placeholder="Type in the network phone" required>
						</fieldset>

						<fieldset class="mb-5">
							<label class="form-label">{{ __('Email') }}</label>
							<input type="text" class="form-control" name="email" placeholder="Type in the network email" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Operators') }}</label>
							<select class="form-control select-select2 operators" name="operators[]"></select>
						</fieldset>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary">
							<i class="fas fa-plus mr-1"></i>
							Create
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- EDIT MODAL -->
	<div class="modal fade" id="edit-modal">
		<div class="modal-dialog modal-lg modal-dialog-centered">
			<div class="modal-content">
				<form id="edit-modal-form">
					@method('PUT')
					
					<div class="modal-header">
						<h5 class="modal-title">Create Record</h5>
						<button class="btn btn-default btn-sm" data-dismiss="modal">
							<i class="fas fa-times fa-lg"></i>
						</button>
					</div>
					<div class="modal-body">
						<fieldset class="mb-3">
							<label class="form-label">{{ __('Category') }}</label>
							<select class="form-control select-select2 category" name="category_id" required></select>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Title') }}</label>
							<input type="text" class="form-control" name="title" placeholder="Type in the network title/name" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Logo') }}</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="logo" id="logo">
								<label class="custom-file-label" for="logo">Choose Logo</label>
							</div>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Background') }}</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" name="background" id="background" required>
								<label class="custom-file-label" for="background">Choose Background</label>
							</div>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Description') }}</label>
							<textarea class="form-control" rows="5" name="description" placeholder="Type in a few lines of description" required></textarea>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Phone') }}</label>
							<input type="text" class="form-control" name="phone" placeholder="Type in the network phone" required>
						</fieldset>

						<fieldset class="mb-5">
							<label class="form-label">{{ __('Email') }}</label>
							<input type="text" class="form-control" name="email" placeholder="Type in the network email" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Operators') }}</label>
							<select class="form-control select-select2 operators" name="operators[]"></select>
						</fieldset>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
						<button type="submit" class="btn btn-primary"><i class="fas fa-check mr-1"></i>Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script>
        $(window).on('load', function () {
            $('.select-select2.category').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: 'Please select category',
                ajax: {
                    url: '{{ route('pagination.categories') }}',
                    delay: 250,
                    dataType: 'json',
                    processResults: function (response) {
                        return {
                            results: response.data,
                            pagination: {
                                more: response.current_page < response.last_page
                            }
                        };
                    }
                }
            });

			$('.select-select2.operators').select2({
				theme: 'bootstrap4',
				multiple: true,
				width: '100%',
				placeholder: 'Please select operators',
				ajax: {
					url: '{{ route('pagination.network.operators') }}',
					delay: 250,
					dataType: 'json',
					processResults: function (response) {
						return {
							results: response.data,
							pagination: {
								more: response.current_page < response.last_page
							}
						};
					}
				}
			});

			new Crud({
                columns: [
                    {title: 'LOGO', data: 'logo'},
                    {title: 'TITLE', data: 'title'},
                    {title: 'DESCRIPTION', data: 'description'},
                    {title: 'PHONE', data: 'phone'},
                    {title: 'EMAIL', data: 'email'},
                    {title: 'STATUS', data: 'status'},
                    {title: 'CREATED AT', data: 'created_at'},
                    {title: 'ACTIONS', data: 'actions'},
                ],
                routes: {
                    index: "{{ route('network.channels.index') }}",
                    store: "{{ route('network.channels.store') }}",
                },
                callbacks: {
                    read: function (response, modal) {
                        if (response.status) {
                            modal.find('.select-select2').empty();

                            // Category
							const category = new Option(response.data.channel.category.title, response.data.channel.category.id, true, true);
							modal.find('.select-select2.category').append(category).trigger('change');

                            modal.find('[name="title"]').val(response.data.channel.title);
                            modal.find('[name="description"]').val(response.data.channel.description);
                            modal.find('[name="phone"]').val(response.data.channel.description);
                            modal.find('[name="email"]').val(response.data.channel.description);

							// Operators
							$.each(response.data.operators, (i, item) => {
								const option = new Option(item.name, item.id, true, true);
								modal.find('.select-select2.operators').append(option).trigger('change');
							});
						}
                    },
                }
            });
        });
	</script>
@endsection