@extends('layouts.channel.app')

@section('page_css')
@endsection

@section('content')
	<div class="card border">
		<div class="card-header d-flex justify-content-between align-items-center">
			<div class="font-weight-bold" style="font-size: 16px;">SEASONS</div>
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
						<div class="row">
							<div class="col">
								<section class="mb-4">
									<h6 class="mb03">For Which Show</h6>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Show') }}</label>
										<select class="select-select2 show" name="show_id" required></select>
									</fieldset>
								</section>
								
								<section class="mb-4">
									<h6 class="mb03">Basic Details</h6>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Title') }}</label>
										<input type="text" class="form-control" name="title">
									</fieldset>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Description') }}</label>
										<textarea class="form-control" rows="5" name="description" required></textarea>
									</fieldset>
								</section>
							</div>
							<div class="col">
								<section class="mb-4">
									<h6 class="mb03">Poster</h6>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Poster') }}</label>
										<input type="hidden" name="poster" required>
										<div class="custom-file">
											<input type="file" class="custom-file-input choose-media" data-type="image" id="choose-poster">
											<label class="custom-file-label text-truncate" for="choose-poster">Choose media</label>
										</div>
										<div class="preview"></div>
									</fieldset>
								</section>

								<section class="mb-4">
									<h6 class="mb-3">TRAILER</h6>
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Trailer') }}</label>
										<input type="hidden" name="trailer" required>
										<div class="custom-file">
											<input type="file" class="custom-file-input choose-media" data-type="video"
												   id="choose-trailer">
											<label class="custom-file-label text-truncate" for="choose-trailer">Choose media</label>
										</div>
									</fieldset>
								</section>

								<section class="mb-4">
									<h6 class="mb03">SEO</h6>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Meta Title') }}</label>
										<input type="text" class="form-control" name="meta_title">
									</fieldset>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Meta Description') }}</label>
										<textarea class="form-control" rows="5" name="meta_description"></textarea>
									</fieldset>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Meta Keywords (comma separated)') }}</label>
										<input type="text" class="form-control" name="meta_keywords">
									</fieldset>
								</section>
							</div>
						</div>
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
	
	<!-- Edit Modal -->
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
						<div class="row">
							<div class="col">
								<section class="mb-4">
									<h6 class="mb03">For Which Show</h6>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Show') }}</label>
										<select class="select-select2 show" name="show_id" required></select>
									</fieldset>
								</section>
								
								<section class="mb-4">
									<h6 class="mb03">Basic Details</h6>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Title') }}</label>
										<input type="text" class="form-control" name="title">
									</fieldset>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Description') }}</label>
										<textarea class="form-control" rows="5" name="description" required></textarea>
									</fieldset>
								</section>
							</div>
							<div class="col">
								<section class="mb-4">
									<h6 class="mb03">Poster</h6>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Poster') }}</label>
										<input type="hidden" name="poster" required>
										<div class="custom-file">
											<input type="file" class="custom-file-input choose-media" data-type="image" id="choose-poster">
											<label class="custom-file-label text-truncate" for="choose-poster">Choose media</label>
										</div>
										<div class="preview"></div>
									</fieldset>
								</section>

								<section class="mb-4">
									<h6 class="mb-3">TRAILER</h6>
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Trailer') }}</label>
										<input type="hidden" name="trailer" required>
										<div class="custom-file">
											<input type="file" class="custom-file-input choose-media" data-type="video"
												   id="choose-trailer">
											<label class="custom-file-label text-truncate" for="choose-trailer">Choose media</label>
										</div>
									</fieldset>
								</section>

								<section class="mb-4">
									<h6 class="mb03">SEO</h6>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Meta Title') }}</label>
										<input type="text" class="form-control" name="meta_title">
									</fieldset>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Meta Description') }}</label>
										<textarea class="form-control" rows="5" name="meta_description"></textarea>
									</fieldset>
									
									<fieldset class="mb-3">
										<label class="form-label">{{ __('Meta Keywords (comma separated)') }}</label>
										<input type="text" class="form-control" name="meta_keywords">
									</fieldset>
								</section>
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
            $('.select-select2.show').select2({
                width: '100%',
                placeholder: 'Please select option',
                ajax: {
                    url: '{{ route('pagination.shows') }}',
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
                    {title: 'POSTER', data: 'poster'},
                    {title: 'TITLE', data: 'title'},
                    {title: 'SHOW', data: 'show'},
                    {title: 'META TITLE', data: 'meta_title'},
                    {title: 'META DESCRIPTION', data: 'meta_description'},
                    {title: 'META KEYWORDS', data: 'meta_keywords'},
                    {title: 'STATUS', data: 'status'},
                    {title: 'CREATED AT', data: 'created_at'},
                    {title: 'ACTIONS', data: 'actions'},
                ],
                routes: {
                    index: "{{ route('channel.seasons.index') }}",
                    store: "{{ route('channel.seasons.store') }}",
                },
                callbacks: {
                    create: function (response, form) {
                        form.find('input:not([name="_method"], [type="checkbox"]), textarea').val('');
                        form.find('.select-select2').empty().trigger('change');
                    },
                    read: function (response, modal) {
                        if (response.status) {
                            console.log(modal, response);

                            modal.find('.select-select2').empty()
	                        
                            const option = new Option(response.data.show.title, response.data.show.id, true, true);
                            modal.find('.select-select2.show').append(option).trigger('change');

                            modal.find('[name="title"]').val(response.data.season.title);
                            modal.find('[name="trailer"]').val(response.data.season.trailer);

							// Poster
                            const poster = modal.find('[name="poster"]');
                            poster.val(response.data.media.poster.id);
                            poster.parent().find('.choose-media').next().text(response.data.media.poster.title);
                            poster.parent().find('.preview').html('<img class="img-thumbnail img-fluid mt-1" src="' + config.storage + response.data.media.poster.path + '">');

							// Trailer
							const trailer = modal.find('[name="trailer"]');
							trailer.val(response.data.media.trailer.id);
							trailer.parent().find('.choose-media').next().text(response.data.media.trailer.title);

							modal.find('[name="meta_title"]').val(response.data.season.meta_title);
                            modal.find('[name="meta_description"]').val(response.data.season.meta_description);
                            modal.find('[name="meta_keywords"]').val(response.data.season.meta_keywords);
                        }
                    },
                    update: (response, form) => {
                        form.find('input:not([name="_method"], [type="checkbox"]), textarea').val('');
                        form.find('.select-select2').empty().trigger('change');
                    }
                }
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