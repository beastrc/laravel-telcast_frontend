/*
 * Crud.js
 * Description: A Js Class that can perform crud operations with datatables and bootstrap modals with ease
 * Author: MR_AMDEV
 * Copyright (c) 2021. This class is made by the author to be intended used for free. No reselling is allowed although a permission from the developer is needed.
 */

class VideoPlayer {
    constructor(options = {}) {
        Object.assign(this, {
            playerSelector: '#main-player',
            playerInstance: null,
            playerOptions: {
                controlBar: {
                    children: [
                        "playToggle",
                        "progressControl",
                        "RemainingTimeDisplay",
                        "VolumePanel",
                        "qualitySelector",
                        "PictureInPictureToggle",
                        "fullscreenToggle"
                    ]
                }
            },
            currentTime: null,
            resource: {
                name: null,
                id: null,
                type: null
            },
            comments: {
                form: '#comments-form',
                section: '.comments-all',
            },
            routes: {
                watch: null,
                like: null,
                dislike: null,
                comment: null
            },
            intervalArray: [],
            updatedCurrentTime: false,
        }, options);

        // Initiate all registered events
        this.registerEvents();
    }

    registerEvents() {
        this.initiatePlayer();
        this.listenEvents();
        this.listenLike();
        this.listenDislike();
        this.createComment();
    }

    initiatePlayer() {
        let _this = this;

        _this.playerInstance = videojs(_this.playerSelector, _this.playerOptions);
    }

    listenEvents() {
        let _this = this;

        // Listen to 'play' event
        _this.playerInstance.on('play', (e) => {
            if (_this.currentTime !== null) {
                if (!_this.updatedCurrentTime) {
                    _this.playerInstance.currentTime(_this.currentTime);
                    _this.updatedCurrentTime = true;
                }
            }
        });

        // Listen to 'playing' event
        _this.playerInstance.on('playing', delay((e) => {
            _this.createWatchLog();
        }, 1000));

        _this.playerInstance.on('pause', (e) => {
            // if(!_this.playerInstance.paused()){
            //     const interval = parseInt(_this.playerInstance.currentTime());
            //
            //     if(parseInt(intervalArray.at(-1) + 1) !== interval){
            //         intervalArray.push(interval);
            //     }
            // }

            // console.log(e);
        });

        _this.playerInstance.on('timeupdate', (e) => {
            // const interval = parseInt(_this.playerInstance.currentTime());
            //
            // if(intervalArray.length){
            //     if(parseInt(intervalArray.at(-1) + 1) === interval){
            //         intervalArray.push(interval);
            //     }
            // }
            // else{
            //     intervalArray.push(interval);
            // }

            // console.log(e, intervalArray);
        });

        // Listen to window/tab closing event
        window.addEventListener("beforeunload", function (e) {
            // Pause current video
            _this.playerInstance.pause();

            // Update watch log
            _this.createWatchLog();
        });
    }

    createWatchLog() {
        let _this = this;

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            method: "POST",
            dataType: "json",
            url: _this.routes.watch,
            data: {
                watchable_id: _this.resource.id,
                watchable_type: _this.resource.type,
                current_time: _this.playerInstance.currentTime(),
            },
        });
    }

    listenLike() {
        let _this = this;

        $('.btn-like').on('click', (e) => {
            const btn = $(e.currentTarget);
            const id = btn.attr('data-id');

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "POST",
                dataType: "json",
                url: _this.routes.like,
                data: {
                    id: id,
                    resource: _this.resource.name
                },
                success: function (response) {
                    if (response.status) {
                        btn.find('span').text(response.data.likes);
                        $('.btn-dislike').find('span').text(response.data.dislikes);

                        btn.toggleClass('active');
                    }
                },
            });
        });
    }

    listenDislike() {
        let _this = this;

        $('.btn-dislike').on('click', (e) => {
            const btn = $(e.currentTarget);
            const id = btn.attr('data-id');

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "POST",
                dataType: "json",
                url: _this.routes.dislike,
                data: {
                    id: id,
                    resource: _this.resource.name
                },
                success: function (response) {
                    if (response.status) {
                        btn.find('span').text(response.data.dislikes);
                        $('.btn-like').find('span').text(response.data.likes);

                        btn.toggleClass('active');
                    }
                },
            });
        });
    }

    createComment() {
        let _this = this;

        $(document).on('submit', _this.comments.form, (e) => {
            const form = $(e.target);
            const btn = form.find(':submit');

            const parent_id = btn.attr('data-parent-id');
            const content = form.find('[name="content"]').val();

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "POST",
                dataType: "json",
                url: _this.routes.comment,
                data: {
                    parent_id: parent_id || null,
                    id: _this.resource.id,
                    type: _this.resource.type,
                    content: content,
                },
                beforeSend: () => {
                    btn.addClass('disabled').attr('disabled', 'disabled');
                    btn.html('<i class="fas fa-spinner fa-pulse fa-sm"></i>');
                },
                success: function (response) {
                    btn.removeClass('disabled').removeAttr('disabled');
                    btn.html('COMMENT');

                    if (response.status) {
                        const html =
                            '<fieldset class="row my-4">' +
                            '   <div class="col-2 text-center">' +
                            '       <img src="http://telcast.test/storage/media/default.png"' +
                            '            class="rounded-circle border img-fluid img-thumbnail"' +
                            '            style="width: 48px;height: 48px;">' +
                            '   </div>' +
                            '   <div class="col-10 p-0 w-100 mb-0">' +
                            '       <div>' +
                            '           <span class="font-weight-bold mr-2">Watch Dose</span>' +
                            '           <span class="small"></span>' +
                            '       </div>' +
                            '       <div>' + response.data.content + '</div>' +
                            '       <div class="d-flex align-items-center mt-1">' +
                            '           <a class="mr-3">' +
                            '               <i class="fas fa-thumbs-up mr-2"></i>' +
                            '               <span>3310</span>' +
                            '           </a>' +
                            '           <a class="mr-3">' +
                            '               <i class="fas fa-thumbs-down mr-2"></i>' +
                            '               <span>3310</span>' +
                            '           </a>' +
                            '           <a class="btn-reply my-auto cursor-pointer" data-parent-id="' + response.data.id + '">REPLY</a>' +
                            '       </div>' +
                            '   </div>' +
                            '</fieldset>';

                        form.parents('.row:first').next().prepend(html);
                        $('.comments-count').text(parseInt($('.comments-count').text()) + 1);
                    }
                },
            });

            return false;
        });
    }
}