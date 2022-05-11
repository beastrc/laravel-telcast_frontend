@extends('layouts.channel.app')

@section('page_css')
@endsection

@section('content')
	<div class="card border">
		<div class="card-header d-flex justify-content-between align-items-center">
			<div class="font-weight-bold" style="font-size: 16px;">SPOTLIGHTS</div>
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
						<section class="mb-4">
							<fieldset class="mb-3">
								<label class="form-label">{{ __('Genres') }}</label>
								<select class="form-control select-select2 genres" name="genre"
										required></select>
							</fieldset>

							<fieldset class="mb-3">
								<label class="form-label">{{ __('Segment') }}</label>
								<select class="form-control select-select2 segment" name="segment" required>
									<option value="" selected>Please select segment to view relevant items</option>
									<option value="movie">Movie</option>
									<option value="show">Show</option>
									<option value="season">Season</option>
									<option value="episode">Episode</option>
									<option value="live">Live</option>
									<option value="sport">Sport</option>
								</select>
							</fieldset>

							<fieldset class="mb-3">
								<label class="form-label">{{ __('Select Item to Spotlight') }}</label>
								<select class="form-control select-select2 spotlight" name="spotlight"
										required></select>
							</fieldset>
						</section>
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
@endsection

@section('page_js')
	<script>
        $(window).on('load', function () {
			let genre_id = null;
			let segment = null;

			$('.select-select2.genres').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: 'Please select option',
                ajax: {
                    url: '{{ route('pagination.genres') }}',
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

			$('.select-select2.genres').on('select2:select', function (e) {
				const selected = e.params.data;

				genre_id = selected.id;
				$('.select-select2.spotlights').empty();
			});

			$('.select-select2.segment').select2({
				theme: 'bootstrap4',
				width: '100%',
				placeholder: 'Please select option',
			});

			$('.select-select2.segment').on('select2:select', function (e) {
				const selected = e.params.data;

				segment = selected.id;
				$('.select-select2.spotlight').empty();
			});

			$('.select-select2.spotlight').select2({
				theme: 'bootstrap4',
				width: '100%',
				placeholder: 'Please select item to spotlight',
				ajax: {
					url: '{{ route('pagination.spotlights') }}',
					delay: 250,
					dataType: 'json',
					data: function (params) {
						return {
							term: params.term,
							page: params.page,
							genre: genre_id,
							segment: segment,
						};
					},
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
                    {title: 'POSTER', data: 'poster'},
                    {title: 'TITLE', data: 'title'},
                    {title: 'TYPE', data: 'type'},
                    {title: 'CREATED AT', data: 'created_at'},
                    {title: 'ACTIONS', data: 'actions'},
                ],
                routes: {
                    index: "{{ route('channel.spotlights.index') }}",
                    store: "{{ route('channel.spotlights.store') }}",
                },
            });

            new ChooseMedia({
                routes: {
                    upload: '{{ route('channel.media.store') }}',
                    media: '{{ route('pagination.media') }}'
                }
            });
        });
	</script>
@endsection