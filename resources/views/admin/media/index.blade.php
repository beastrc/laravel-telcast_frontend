@extends('layouts.admin.app')

@section('page_css')
	<style>
        .progress-bar {
            width: 0% !important;
        }
	</style>
@endsection

@section('content')
	<div class="card border">
		<div class="card-header d-flex justify-content-between align-items-center">
			<div class="font-weight-bold" style="font-size: 16px;">MEDIA</div>
			<div>
				<button class="btn btn-primary rounded-sm" data-toggle="modal" data-target="#create-modal">
					Upload New
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
				<div class="modal-header">
					<h5 class="modal-title">Upload Media</h5>
					<button class="btn btn-default btn-sm" data-dismiss="modal">
						<i class="fas fa-times fa-lg"></i>
					</button>
				</div>
				<div class="modal-body">
					<section class="section-1 py-4 h-100">
						<div class="mx-auto bg-light rounded-circle text-dark d-flex justify-content-center mb-4"
						     style="height: 150px; width: 150px;">
							<i class="fas fa-upload fa-4x my-auto"></i>
						</div>
						<h5 class="text-center">Please select media to upload</h5>
						<fieldset class="my-3 text-center">
							<div class="custom-file" style="width: 400px">
								<input type="file" class="custom-file-input cursor-pointer" name="media" id="media" required>
								<label class="btn btn-primary bg-primary text-light d-none-after custom-file-label"
								       for="media">Choose media</label>
							</div>
						</fieldset>
					</section>
					
					<section class="section-2 h-100" style="display: none">
						<fieldset class="mb-3 h5">
							<h5 class="mb-1">Uploading ...</h5>
							<div class="progress rounded-0 mb-3" style="height: 30px;">
								<div class="progress-bar upload-progress-bar">0%</div>
							</div>
							<h6 class="text-center">Please keep the page open until its uploaded!</h6>
						</fieldset>
					</section>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page_js')
	<script>
        Dropzone.autoDiscover = false;

        $(window).on('load', function () {
            const CrudClass = new Crud({
                columns: [
                    {title: 'TITLE', data: 'title'},
                    {title: 'TYPE', data: 'type'},
                    {title: 'SIZE', data: 'size'},
                    {title: 'EXTENSION', data: 'extension'},
                    {title: 'DURATION', data: 'duration'},
                    {title: 'CREATED AT', data: 'created_at'},
                    {title: 'ACTIONS', data: 'actions'},
                ],
                routes: {
                    index: "{{ route('admin.media.index') }}",
                    store: "{{ route('admin.media.store') }}",
                },
                callbacks: {
                    read: function (response, modal) {
                        if (response.status) {
                            console.log(modal, response);

                            modal.find('.select-select2').empty()
                            const option = new Option(response.show.title, response.show.id, true, true);
                            modal.find('.select-select2.show').append(option).trigger('change');

                            modal.find('[name="title"]').val(response.data.title);
                            modal.find('[name="trailer"]').val(response.data.trailer);

                            modal.find('[name="poster"]').val(response.data.poster);
                            modal.find('.preview').html('<img class="img-thumbnail img-fluid mt-1" src="' + response.data.poster + '">');

                            modal.find('[name="meta_title"]').val(response.data.meta_title);
                            modal.find('[name="meta_description"]').val(response.data.meta_description);
                            modal.find('[name="meta_keywords"]').val(response.data.meta_keywords);
                        }
                    },
                }
            });

            new Dropzone(document.createElement('div'), {
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "{{ route('admin.media.store') }}",
                method: "POST",
                paramName: 'media',
                multiple: false,
                chunking: true,
                maxFilesize: null,  // Unlimited size
                parallelUploads: 1,
                parallelChunkUploads: true,
                retryChunks: true,
                chunkSize: 2000000, // In bytes i.e. 2MB
                previewTemplate: '<span/>',
                acceptedFiles: [
	                'video/mp4',
		            'video/webm',
		            'video/x-ms-asf',
		            'video/x-ms-wmv',
		            'video/ogg',
                    'video/x-msvideo',
                    'video/quicktime',
                    'video/x-flv',
                    'image/jpeg',
                    'image/gif',
                    'image/png',
                    'image/bmp',
                    'image/svg+xml',
	                '.vtt',
	            ].join(','),
                init: function () {
                    let _instance = this;
                    let _modal = $('#create-modal, #edit-modal');
                    let _input = $('input[name=media]');
                    let _progress = $('.upload-progress-bar');
                    
                    _input.on('change', function () {
                        if (typeof this.files[0] === 'object') {
                            console.log();
                            _instance.addFile(this.files[0]);
                        }
                    });

                    _instance.on('addedfile', function (file, xhr, formData) {
                        $('.section-1, .section-2').toggle();
                    });

                    _instance.on('sending', function (file, xhr, formData) {
                        formData.append('_token', '{{ csrf_token() }}');
                        
                        // This will track all request so we can get the correct request that returns final response:
                        // We will change the load callback but we need to ensure that we will call original
                        // load callback from dropzone
                        const dropzoneOnLoad = xhr.onload;
                        xhr.onload = function (e) {
                            dropzoneOnLoad(e)

                            // Check for final chunk and get the response
                            if (xhr.response) {
                                const response = JSON.parse(xhr.responseText);

                                // If upload is completed
                                if (response.status && response.uploaded) {
                                    // Reset upload input
                                    _input.val('');

                                    $('.section-1, .section-2').toggle();

                                    _progress.attr('style', 'width: 0% !important;');
                                    _progress.text('0%');
                                    
                                    CrudClass.refreshTable();
                                    
                                    $('#create-modal').modal('hide');
                                }
                            }
                        }
                    });

                    _instance.on('uploadprogress', function (response) {
                        if (response.status) {
                            const progress = response.upload.progress;
                            _progress.attr('style', 'width: ' + progress + '%!important;');
                            _progress.text(Math.trunc(progress) + '%');
                        }
                    });
                }
            });
        });
	</script>
@endsection