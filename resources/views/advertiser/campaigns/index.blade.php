@extends('layouts.advertiser.app')

@section('page_css')
@endsection

@section('content')
	<div class="card border">
		<div class="card-header d-flex justify-content-between align-items-center">
			<div class="font-weight-bold" style="font-size: 16px;">CAMPAIGNS</div>
			<div>
				<a class="btn btn-primary rounded-sm" href="/createcampaign">Create New<i class="fas fa-plus ml-1"></i></a>
				<!-- <button class="btn btn-primary rounded-sm" data-toggle="modal" data-target="#create-modal">
					Create New
					<i class="fas fa-plus ml-1"></i>
				</button> -->
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
		<div class="modal-dialog modal-dialog-centered modal-lg">
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
							<label class="form-label">{{ __('Country') }}</label>
							<input type="text" class="form-control" name="country" required>
						</fieldset>
						
						<fieldset class="mb-3">
							<label class="form-label">{{ __('State') }}</label>
							<input type="text" class="form-control" name="state" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('age') }}</label>
							<input type="number" class="form-control" name="age" min="0" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('gender') }}</label>
							<select class="form-control" name="gender" required>
								<option value="auto" selected>Auto</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
								<option value="other">Other</option>
							</select>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Link/URL of Resource') }}</label>
							<input type="text" class="form-control" name="link" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Your Bid') }}</label>
							<input type="text" class="form-control" name="bid" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Spending Limit') }}</label>
							<input type="text" class="form-control" name="limit" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Channels') }}</label>
							<select class="form-control select-select2 channels" name="channels[]"></select>
							<small class="form-text text-muted">
								<strong>INFO:</strong>
								Select Specific Channels to advertise on or let the system decide automatically
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
		<div class="modal-dialog modal-dialog-centered modal-lg">
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
							<label class="form-label">{{ __('Country') }}</label>
							<input type="text" class="form-control" name="country" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('State') }}</label>
							<input type="text" class="form-control" name="state" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('age') }}</label>
							<input type="number" class="form-control" name="age" min="0" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('gender') }}</label>
							<select class="form-control" name="gender" required>
								<option value="auto" selected>Auto</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
								<option value="other">Other</option>
							</select>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Link/URL of Resource') }}</label>
							<input type="text" class="form-control" name="link" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Your Bid') }}</label>
							<input type="text" class="form-control" name="bid" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Spending Limit') }}</label>
							<input type="text" class="form-control" name="limit" required>
						</fieldset>

						<fieldset class="mb-3">
							<label class="form-label">{{ __('Channels') }}</label>
							<select class="form-control select-select2 channels" name="channels[]"></select>
							<small class="form-text text-muted">
								<strong>INFO:</strong>
								Select Specific Channels to advertise on or let the system decide automatically
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
			$('.select-select2.channels').select2({
				theme: 'bootstrap4',
				multiple: true,
				width: '100%',
				placeholder: 'Please Select Channels',
				ajax: {
					url: '{{ route('pagination.channels') }}',
					delay: 250,
					dataType: 'json',
					processResults: function (response) {
						return {
							results: response.data,
							pagination: {
								more: response.current_page < response.total
							}
						};
					}
				}
			});

            new Crud({
                columns: [
                    {title: 'ACTIONS', data: 'actions'},
                    {title: 'TITLE', data: 'title'},
                    {title: 'GEOGRAPHIC', data: 'geographic'},
                    {title: 'BID', data: 'bid'},
                    {title: 'LIMIT', data: 'limit'},
                    {title: 'STATUS', data: 'status'},
                    {title: 'CREATED AT', data: 'created_at'},
                ],
                routes: {
                    index: "{{ route('advertiser.campaigns.index') }}",
                    store: "{{ route('advertiser.campaigns.store') }}",
                },
                callbacks: {
                    read: function (response, modal) {
                        if (response.status) {
							modal.find('.select-select2').empty();

							modal.find('[name="title"]').val(response.data.campaign.title);
                            modal.find('[name="country"]').val(response.data.campaign.country);
                            modal.find('[name="state"]').val(response.data.campaign.state);
                            modal.find('[name="age"]').val(response.data.campaign.age);
                            modal.find('[name="gender"]').val(response.data.campaign.gender);
                            modal.find('[name="link"]').val(response.data.campaign.link);
                            modal.find('[name="bid"]').val(response.data.campaign.bid);
                            modal.find('[name="limit"]').val(response.data.campaign.limit);

							if(response.data.channels){
								$.each(response.data.channels, (i, item) => {
									const option = new Option(item.title, item.id, true, true);
									modal.find('.select-select2.channels').append(option).trigger('change');
								});
							}
                        }
                    }
                }
            });
        });
	</script>
@endsection