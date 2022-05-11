class ChooseMedia {
    constructor(options = {}) {
        Object.assign(this, {
            selector: $('.choose-media'),
            modal: $('#choose-modal'),
            tabUpload: $('#choose-upload-tab'),
            tabMedia: $('#choose-media-tab'),
            contentUpload: $('#choose-upload-content'),
            contentMedia: $('#choose-media-content'),
            routes: {
                upload: null,
                media: null,
            },
            callbacks: {
                upload: null,
                loadMedia: null
            }
        }, options);

        // Initiate all registered events
        this.registerEvents();
    }

    registerEvents() {
        Dropzone.autoDiscover = false;

        this.init();
        this.upload();
        this.loadMedia();
        this.selectMedia();
        this.closeModal();
    }

    init() {
        let _this = this;

        _this.selector.on('click', (e) => {
            _this.tabUpload.tab('show');

            const triggered_input = $(e.currentTarget);
            const triggered_modal = triggered_input.parents('.modal').attr('id');
            const triggered_item = triggered_input.parents('fieldset:first').find('input[type="hidden"]:first').attr('name');

            _this.modal.attr({
                'data-target-modal': '#' + triggered_modal,
                'data-target-input': '#' + triggered_input.attr('id'),
                'data-target-item': '[name="' + triggered_item + '"]',
                'data-target-type': triggered_input.attr('data-type')
            });

            $('#' + triggered_modal).modal('hide');
            _this.modal.modal('show');

            return false;
        });
    }

    upload() {
        let _this = this;

        new Dropzone(document.createElement('div'), {
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: _this.routes.upload,
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
                let _input = _this.contentUpload.find('#choose-media-input');
                let _progress = $('.upload-progress-bar');

                _input.on('change', function () {
                    if (typeof this.files[0] === 'object') {
                        _instance.addFile(this.files[0]);
                    }
                });

                _instance.on('addedfile', function (file, xhr, formData) {
                    $('.section-1, .section-2').toggle();
                });

                _instance.on('sending', function (file, xhr, formData) {
                    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

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

                                _this.tabMedia.tab('show');

                                if (_this.callbacks.upload && typeof (_this.callbacks.upload) === "function") {
                                    _this.callbacks.upload(response);
                                }
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
    }

    loadMedia() {
        let _this = this;

        _this.tabMedia.on('show.bs.tab', function (e) {
            const currTab = $(e.target); // newly activated tab
            const prevTab = $(e.relatedTarget); // previous active tab

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "GET",
                dataType: 'json',
                url: _this.routes.media,
                data: {type: _this.modal.attr('data-target-type')},
                beforeSend: function () {
                    currTab.find('i').show();
                    _this.contentMedia.find('.row:first').empty();
                },
                success: function (response) {
                    currTab.find('i').hide();

                    console.log(response);

                    if (_this.callbacks.loadMedia && typeof (_this.callbacks.loadMedia) === "function") {
                        _this.callbacks.loadMedia(response, currTab, prevTab);
                    }

                    if (response.data.length) {
                        $.each(response.data, (i, media) => {
                            let url, icon;

                            switch (media.type) {
                                case 'application/octet-stream':
                                    url = config.media + media.id;
                                    icon = '<img src="' + config.asset + 'images/editor.svg" width="64" class="my-auto mx-auto">';
                                    break;

                                default:
                                    url = config.storage + media.path;
                                    icon = '<img src="' + config.asset + 'images/picture.svg" width="64" class="my-auto mx-auto">';
                                    break;
                            }

                            const html =
                                '<div class="col col-lg-2 col-md-3 pb-4">' +
                                '   <div class="media-item hover-border" data-id="' + media.id + '" data-url="'+url+'" data-title="' + media.title + '">' +
                                '       <div class="border border-bottom-0 d-flex rounded-top" style="height: 100px;">' + icon + '</div>' +
                                '       <div class="small d-block text-truncate text-light bg-primary rounded-bottom px-2" title="' + media.title + '">' + media.title + '</div>' +
                                '   </div>' +
                                '</div>';

                            _this.contentMedia.find('.row:first').append(html);
                        });
                    }
                },
                error: function (response, status, errorThrown) {
                    currTab.find('i').hide();
                    swal.fire(errorThrown, JSON.stringify(response.responseJSON, null, 2), 'error');
                }
            });
        })
    }

    selectMedia() {
        let _this = this;

        _this.contentMedia.on('click', '.media-item', (e) => {
            const media = $(e.currentTarget);
            const media_id = media.attr('data-id');
            const media_url = media.attr('data-url');
            const media_title = media.attr('data-title');

            // Get target modal id and target item name
            const target_modal = _this.modal.attr('data-target-modal');
            const target_input = _this.modal.attr('data-target-input');
            const target_item = _this.modal.attr('data-target-item');

            // Show media title as input selected file
            $(target_modal).find(target_input).next().text(media_title);

            // Set media id as value of the target item
            $(target_modal).find(target_item).val(media_id);

            // Show preview if present
            const preview = $(target_modal).find(target_input).parent().next('.preview');
            if(preview.length){
                preview.html('<img class="img-thumbnail img-fluid mt-1" src="' + media_url + '">');
            }

            _this.modal.modal('hide');
            $(target_modal).modal('show');
        });
    }

    closeModal() {
        let _this = this;

        _this.modal.on('hide.bs.modal', (e) => {
            // Get target modal id to show it
            const target_modal = _this.modal.attr('data-target-modal');

            $(target_modal).modal('show');
        });
    }
}