@extends('layouts.admin.app')

@section('page_css')
	<link href="{{ asset('css/nestedSortable.css') }}" rel="stylesheet">
@endsection

@section('content')
	<div class="row">
		<div class="col-12 col-md-4 mb-3">
			<div class="card card-create border">
				<div class="card-header fw-bold">
					Create Genre
				</div>
				<div class="card-body card-body-create">
					<form id="create-form">
						<div class="mb-3">
							<label class="form-label">Name</label>
							<input type="text" class="form-control" name="name"
							       placeholder="Enter name of the genre" required>
						</div>
						<div class="mb-3">
							<label class="form-label">Description</label>
							<textarea class="form-control" name="description"
							          placeholder="Enter a short description of the genre"></textarea>
						</div>
						<div class="mb-3">
							<label class="form-label">Thumbnail</label>
							<div class="file-drop-area">
								<span class="choose-file-button fw-bold">Choose File</span>
								<span class="file-message"></span>
								<input type="file" class="file-input" name="thumbnail" accept=".jpg,.jpeg,.png"
								       required>
							</div>
							<div class="file-input-preview"></div>
						</div>
						<button type="submit" class="btn btn-primary">
							Create Genre
						</button>
					</form>
				</div>
			</div>
			
			<div class="card card-edit border" style="display: none;">
				<div class="card-header fw-bold">
					Update Genre
				</div>
				<div class="card-body">
					<form id="edit-form">
						@csrf
						@method('PUT')
						
						<div class="mb-3">
							<label class="form-label">Name</label>
							<input type="text" class="form-control" name="name"
							       placeholder="Enter name of the genre" required>
						</div>
						
						<div class="mb-3">
							<label class="form-label">Description</label>
							<textarea class="form-control" name="description"
							          placeholder="Enter a short description of the genre" required></textarea>
						</div>
						
						<div class="mb-3">
							<label class="form-label">Thumbnail</label>
							<div class="file-drop-area">
								<span class="choose-file-button fw-bold">Choose File</span>
								<span class="file-message"></span>
								<input type="file" class="file-input" name="thumbnail" accept=".jpg,.jpeg,.png">
							</div>
							<div class="file-input-preview"></div>
						</div>
						
						<button type="button" class="btn btn-danger close-btn mr-1">Cancel</button>
						<button type="submit" class="btn btn-warning">Update Genre</button>
					</form>
				</div>
			</div>
		</div>
		
		<div class="col-12 col-md-8 mb-3">
			<div class="card border">
				<div class="card-header fw-bold">
					Genres
				</div>
				<div class="card-body card-body-categories">
					@include('admin.genres.partials.genres', ['genres' => $genres])
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
	        integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
	<script src="{{ asset('js/jquery.mjs.nestedSortable.js') }}"></script>
	<script>
        window.config.routes = {
            index: "{{ route('admin.genres.index') }}"
        }
	</script>
	<script>
        $(window).on('load', function () {
            // Create Genres Class
            class GenreClass {
                constructor(options = {}) {
                    Object.assign(this, {
                        layout: [],
                        pages_body: $('.pages-body'),
                    }, options);
                }

                registerEvents() {
                    this.initSortable();
                    this.create();
                    this.read();
                    this.update();
                    this.delete();
                    this.close();
                }

                initSortable() {
                    let _this = this;

                    // Make pages sortable
                    $('.dd-list').nestedSortable({
                        connectWith: '.dd-list',
                        items: 'li',
                        listType: 'ol',
                        tolerance: 'intersect',
                        tabSize: 36,
                        isTree: true,
                        placeholder: 'dd-placeholder',
                        cursor: 'move',
                        update: (event, ui) => {
                            const data = [];

                            $('#categories li').each((index, li) => {
                                const parent_id = $(li).parent('ol').parent('li').length ? parseInt($(li).parent('ol').parent('li').attr('data-id')) : null;

                                data.push({
                                    id: parseInt($(li).attr('data-id')),
                                    parent_id: parent_id,
                                    order: $(li).index()
                                });
                            });

                            $.ajax({
                                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                type: 'PUT',
                                url: "{{ route('admin.genres.reorder') }}",
                                dataType: 'json',
                                data: {
                                    genres: data
                                },
                            });
                        }
                    });
                }

                create() {
                    let _this = this;

                    $('#create-form').on('submit', function (e) {
                        const form = $(e.currentTarget);
                        const submit = form.find('[type="submit"]');

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            type: 'POST',
                            url: "{{ route('admin.genres.store') }}",
                            dataType: 'json',
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                submit.addClass('disabled').prop('disabled', true);
                            },
                            success: function (response) {
                                submit.removeClass('disabled').prop('disabled', false);
                                console.log(response);

                                if (response.status) {
                                    let html =
                                        `<li class="dd-item dd3-item" id="genre_` + response.data.id + `" data-id="` + response.data.id + `">
                                            <div class="d-flex w-100">
                                                <div class="dd-handle dd3-handle rounded-left"><i class="fas fa-bars mx-auto"></i></div>
                                                <div class="dd3-content rounded-right w-100 p-2 d-inline">
                                                    <div class="d-flex align-items-center justify-content-between">
                                                        <div class="left" data-toggle="collapse" href="#` + response.data.slug + `-` + response.data.id + `">
                                                            <img src="` + config.storage + response.data.thumbnail + `"class="img-thumbnail img-fluid mr-1">
                                                            <strong>` + response.data.name + `</strong>
                                                        </div>
                                                        <span class="right">
							                                <i class="btn-edit fas fa-pencil-alt mr-1" data-url-edit="` + config.routes.index + `/` + response.data.id + `/edit" data-url-update="` + config.routes.index + `/` + response.data.id + `"></i>
															<i class="btn-delete fas fa-times fa-lg text-danger mr-1" data-url="` + config.routes.index + `/` + response.data.id + `"></i>
							                            </span>
                                                    </div>
                                                    <div class="collapse fade" id="` + response.data.slug + `-` + response.data.id + `">
                                                        <div class="card card-body py-0">
						                                    ` + response.data.description + `
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>`;

                                    // Add page to list
                                    $('#categories').append(html);

                                    // Remove no genre text if exists
                                    if ($('.no-genre').length) $('.no-genre').remove();
                                }
                            },
                            error: function (errorThrown, response) {
                                submit.removeClass('disabled').prop('disabled', false);
                                console.log(errorThrown, response);
                            }
                        });

                        return false;
                    });
                }

                read() {
                    let _this = this;

                    $(document).on('click', '.btn-edit', function (e) {
                        const btn = $(e.currentTarget);
                        const url_edit = btn.attr('data-url-edit');
                        const url_update = btn.attr('data-url-update');

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            type: 'GET',
                            url: url_edit,
                            dataType: 'json',
                            beforeSend: function () {
                                btn.toggleClass('fa-pencil-alt fa-spinner').addClass('fa-pulse');
                            },
                            success: function (response) {
                                btn.toggleClass('fa-pencil-alt fa-spinner').removeClass('fa-pulse');
                                console.log(response);

                                if (response.status) {
                                    $('#edit-form').attr('data-url', url_update);
                                    $('#edit-form').find('[name="name"]').val(response.data.name);
                                    $('#edit-form').find('[name="description"]').val(response.data.description);

                                    _this.showEdit();
                                } else {
                                    swal.fire('Error!', response.message, 'error');
                                }
                            },
                            error: function (response, status, errorThrown) {
                                btn.toggleClass('fa-pencil-alt fa-spinner').removeClass('fa-pulse');
                                swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                            }
                        });

                        return false;
                    });
                }

                update() {
                    let _this = this;

                    $('#edit-form').on('submit', function (e) {
                        const form = $(this);
                        const url = form.attr('data-url');

                        $.ajax({
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            type: "POST",
                            dataType: 'json',
                            url: url,
                            data: new FormData(this),
                            contentType: false,
                            processData: false,
                            beforeSend: function () {
                                form.find('button:submit').addClass('disabled').prop('disabled', true);
                            },
                            success: function (response) {
                                form.find('button:submit').removeClass('disabled').prop('disabled', false);

                                if (response.status) {
                                    const genre = $('#genre_' + response.data.id);
                                    genre.find('img:first').attr('src', config.storage + response.data.thumbnail);
                                    genre.find('strong:first').text(response.data.name);
                                    genre.find('.collapse:first .card-body').text(response.data.description);

                                    swal.fire('Success!', response.message, 'success');
                                } else {
                                    swal.fire('Error!', response.message, 'error');
                                }
                            },
                            error: function (response, status, errorThrown) {
                                form.find('button:submit').removeClass('disabled').prop('disabled', false);
                                swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                            }
                        });

                        return false;
                    });
                }

                delete() {
                    let _this = this;

                    $(document).on('click', '.btn-delete', function (e) {
                        const btn = $(e.currentTarget);
                        const url = btn.attr('data-url');

                        _this.hideEdit();

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                                    type: "DELETE",
                                    dataType: 'json',
                                    url: url,
                                    success: function (response) {
                                        if (response.status) {
                                            $('.card-body-categories').html(response.data);
                                            _this.initSortable();
                                        }
                                    },
                                    error: function (response, status, errorThrown) {
                                        swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                                    }
                                });
                            }
                        });
                    });
                }

                close() {
                    let _this = this;

                    $(document).on('click', '.close-btn', (e) => {
                        _this.hideEdit();
                    });
                }
                
                hideEdit(){
                    $('.card-edit').hide('slideDown');
                    $('.card-create').show('slideDown');
                }

                showEdit(){
                    $('.card-create').hide('slideRight');
                    $('.card-edit').show('slideRight');
                }
            }

            // Initiate genre class
            const Genre = new GenreClass();
            Genre.registerEvents();
        });
	</script>
@endsection