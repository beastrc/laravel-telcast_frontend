@extends('layouts.frontend.app')

@section('page_css')
    <link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet">
    <link href="https://unpkg.com/@silvermine/videojs-quality-selector/dist/css/quality-selector.css" rel="stylesheet">
    <link href="{{ asset('css/video.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row container-fluid" style="padding-top: calc(70px + 1rem);">
        <div class="col col-lg-8">
            <section id="section-player" class="mb-2">
                <video id="main-player" class="video-js vjs-default-skin vjs-live vjs-liveui" controls preload="auto"
                       style="width: 100%; height: 360px;" poster="{{ getPoster($live) }}">
                    <source src="https://bitdash-a.akamaihd.net/content/MI201109210084_1/m3u8s/f08e80da-bf1d-4e3d-8899-f0f6155f6efa.m3u8"
                            type='application/x-mpegURL'>
                    {{--					@if(isPremium())--}}
                    {{--						@foreach(getVideos($live) as $media)--}}
                    {{--							<source src="{{ asset('private/media/'.$media->id) }}" type="{{ $media->type }}" label="{{ $media->pivot->type }}" @if($loop->first) selected="true" @endif>--}}
                    {{--						@endforeach--}}
                    {{--					@else--}}
                    {{--						<source src="{{ getTrailerPath($live) }}" type="{{ getTrailerType($live) }}" label="Auto" selected="true">--}}
                    {{--					@endif--}}
                </video>
            </section>

            <section id="section-info">
                <section>
                    <ul class="d-flex align-items-center text-white p-0" style="list-style: none">
                        @foreach($live->genres as $genre)
                            <li class="pr-1">
                                <a href="{{ route('frontend.genres.show', $genre->id) }}">#{{ $genre->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                    <h4 class="text-uppercase mb-2">{{ $live->title }}</h4>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <ul class="list-inline d-flex align-items-center movie-content m-0">
                                <li class="text-white">{{ $views }} views</li>
                                <li class="text-white">{{ $live->created_at->format('M d, Y') }}</li>
                            </ul>
                            <div class="text-white">
                                <i class="fa fa-circle text-danger mr-1" style="font-size: 12px;"></i>
                                Live
                            </div>
                        </div>
                        <div>
                            <button class="btn-like btn btn-sm btn-success p-1 px-2" data-id="{{ $live->id }}">
                                <i class="fa fa-thumbs-up"></i>
                                <span class="likes-count">{{ $likes }}</span>
                            </button>
                            <button class="btn-dislike btn btn-sm btn-secondary p-1 px-2" data-id="{{ $live->id }}">
                                <i class="fa fa-thumbs-down"></i>
                                <span class="dislikes-count">{{ $dislikes }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <ul class="share-icons music-play-lists m-0 p-0">
                            <li><span><i class="ri-add-line"></i></span></li>
                            <li><span><i class="ri-heart-fill"></i></span></li>
                        </ul>
                        <ul class="share-icons music-play-lists m-0 p-0">
                            <li><span><i class="ri-facebook-fill"></i></span></li>
                            <li><span><i class="ri-twitter-fill"></i></span></li>
                            <li class="m-0"><span><i class="ri-links-fill"></i></span></li>
                        </ul>
                    </div>
                </section>

                <section class="py-3 my-3 border-top border-bottom">
                    <div class="row align-items-center mx-0 mb-3">
                        <div class="col-2 text-center">
                            <img src="{{ asset("storage/{$live->channel->logo}") }}" width="48">
                        </div>
                        <div class="col-6 pl-0">
                            <a href="{{ route('frontend.channels.show', $live->channel->id) }}"
                               style="font-size: 1rem;line-height: normal;">{{ $live->channel->title }}</a>
                            <div style="font-size: 0.8rem;line-height: normal">
                                {{ $live->channel()->first()->subscribers()->count() }}
                                <span class="ml-1">subscribers</span>
                            </div>
                        </div>
                        <div class="col-4 pr-0 text-right">
                            @if(isSubscribed($live))
                                <button class="btn btn-danger disabled" disabled><i class="fas fa-bell mr-1"></i>
                                    Subscribed
                                </button>
                            @else
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary btn-block" data-toggle="dropdown">
                                        Subscribe
                                    </button>
                                    <div class="dropdown-menu w-100 my-1 rounded-0">
                                        <button class="dropdown-item cursor-pointer" data-toggle="modal"
                                                data-target="#subscription-modal"
                                                data-action="{{ route('frontend.channels.subscribe', $live->channel->id) }}"
                                                data-price="{{ $live->channel->subscription_price_without_ads }}"
                                                data-type="without_ads">Without Ads
                                            (${{ $live->channel->subscription_price_without_ads }})
                                        </button>
                                        <button class="dropdown-item cursor-pointer" data-toggle="modal"
                                                data-target="#subscription-modal"
                                                data-action="{{ route('frontend.channels.subscribe', $live->channel->id) }}"
                                                data-price="{{ $live->channel->subscription_price_with_ads }}"
                                                data-type="with_ads">With Ads
                                            (${{ $live->channel->subscription_price_with_ads }})
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row align-items-center mx-0">
                        <div class="col-2"></div>
                        <div class="col-10 pl-0 description w-100 mb-0" style="font-size: 16px;">
                            {!! $live->description !!}
                        </div>
                    </div>
                </section>

                <section>
                    <div class="mb-4">
                        <span class="comments-count" style="font-size: inherit">{{ $comments->total() }}</span>
                        Comments
                    </div>
                    <div class="row mx-0">
                        <div class="col-2">
                            <img src="http://telcast.test/storage/media/default.png"
                                 class="rounded-circle border img-fluid img-thumbnail"
                                 style="width: 48px;height: 48px;">
                        </div>
                        <div class="col-10 p-0 w-100 mb-0">
                            <form id="comments-form">
                                <textarea class="h-auto" name="content" rows="2" placeholder="Add a public comment..."
                                          required></textarea>
                                <div class="d-flex mt-2 justify-content-end">
                                    <button type="submit" class="btn btn-success btn-sm">COMMENT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="comments-all">
                        @if(isset($comments) && $comments->isNotEmpty())
                            @foreach($comments as $comment)
                                <fieldset class="row my-4">
                                    <div class="col-2 text-center">
                                        <img src="http://telcast.test/storage/media/default.png"
                                             class="rounded-circle border img-fluid img-thumbnail"
                                             style="width: 48px;height: 48px;">
                                    </div>
                                    <div class="col-10 p-0 w-100 mb-0">
                                        <div>
                                            <span class="font-weight-bold mr-2">{{ $comment->user->name }}</span>
                                            <span class="small">{{ $comment->created_at->diffForHumans() }}</span>
                                        </div>
                                        <div>{{ $comment->content }}</div>
                                        <div class="d-flex align-items-center mt-1">
                                            <a class="mr-3">
                                                <i class="fas fa-thumbs-up mr-2"></i>
                                                <span>3310</span>
                                            </a>
                                            <a class="mr-3">
                                                <i class="fas fa-thumbs-down mr-2"></i>
                                                <span>3310</span>
                                            </a>
                                            <a class="btn-reply my-auto cursor-pointer"
                                               data-parent-id="{{ $comment->id }}">REPLY</a>
                                        </div>
                                    </div>
                                </fieldset>
                            @endforeach
                        @endif
                    </div>
                </section>
            </section>
        </div>

        <div class="col col-lg-4">
            <ul class="list-group p-0" style="list-style: none">
                <li class="p-0 mb-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="font-weight-bold text-light" style="font-size: 18px;">SIMILAR</div>
                        <div class="d-flex slick-aerrow-block"></div>
                    </div>
                    <ul id="slick-similar" class="list-inline">
                        @if(isset($comments) && $comments->isNotEmpty())
                            @foreach($comments as $movie)
                                <li class="d-flex p-0 mb-2">
                                    <a href="#!">
                                        <img src="{{ getPoster($live) }}" style="width: 150px;height: 90px;"/>
                                        <div class="d-flex flex-column ml-2">
                                            <h6 class="mb-2">This is a basic gameplay</h6>
                                            <ul class="d-flex align-items-center text-white p-0"
                                                style="list-style: none">
                                                <li class="pr-1"><a href="">#Action</a></li>
                                                <li class="pr-1"><a href="">#Drama</a></li>
                                                <li class="pr-1"><a href="">#Thriller</a></li>
                                            </ul>
                                            <small>15M views 4 years ago</small>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="p-0 mb-2">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="font-weight-bold text-light" style="font-size: 18px;">UPCOMING</div>
                        <div class="d-flex slick-aerrow-block"></div>
                    </div>
                    <ul id="slick-upcoming" class="list-inline">
                        @if(isset($comments) && $comments->isNotEmpty())
                            @foreach($comments as $movie)
                                <li class="d-flex p-0 mb-2">
                                    <a href="#!">
                                        <img src="{{ getPoster($live) }}" style="width: 150px;height: 90px;"/>
                                        <div class="d-flex flex-column ml-2">
                                            <h6 class="mb-2">This is a basic gameplay</h6>
                                            <ul class="d-flex align-items-center text-white p-0"
                                                style="list-style: none">
                                                <li class="pr-1"><a href="">#Action</a></li>
                                                <li class="pr-1"><a href="">#Drama</a></li>
                                                <li class="pr-1"><a href="">#Thriller</a></li>
                                            </ul>
                                            <small>15M views 4 years ago</small>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </li>
                <li class="p-0 mb-2">
                    <div class="font-weight-bold text-light" style="font-size: 18px;">NEXT</div>
                </li>
                <li class="d-flex p-0 mb-2">
                    <a href="#!">
                        <img src="{{ getPoster($live) }}" style="width: 150px;height: 90px;"/>
                        <div class="d-flex flex-column ml-2">
                            <h6 class="mb-2">This is a basic gameplay</h6>
                            <ul class="d-flex align-items-center text-white p-0" style="list-style: none">
                                <li class="pr-1"><a href="">#Action</a></li>
                                <li class="pr-1"><a href="">#Drama</a></li>
                                <li class="pr-1"><a href="">#Thriller</a></li>
                            </ul>
                            <small>15M views 4 years ago</small>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('page_js')
    <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
    <script src="https://unpkg.com/@silvermine/videojs-quality-selector/dist/js/silvermine-videojs-quality-selector.min.js"></script>
    <script src="{{ asset('js/VideoPlayer.js') }}"></script>
    <script>
        $(window).on('load', e => {
            new VideoPlayer({
                playerOptions: {
                    liveui: true,
                },
                currentTime: @if(request()->has('t')) {{ request()->input('t') }} @else null @endif,
                resource: {
                    name: 'live',
                    id: {{ $live->id }},
                    type: "{{ urlencode(get_class($live)) }}",
                },
                routes: {
                    watch: "{{ route('frontend.watches.store') }}",
                    like: "{{ route('frontend.likes.like') }}",
                    dislike: "{{ route('frontend.likes.dislike') }}",
                    comment: "{{ route('frontend.comments.store') }}"
                },
            });

        });

        const options = {
            lazyLoad: 'ondemand',
            dots: false,
            arrows: true,
            infinite: true,
            speed: 300,
            autoplay: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            nextArrow: '<button class="slick-arrow slick-next"><i class="fa fa-chevron-right"></i></button>',
            prevArrow: '<button class="slick-arrow slick-prev"><i class="fa fa-chevron-left"></i></button>',
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        };

        $('#slick-similar').slick({
            ...options,
            appendArrows: $('#slick-similar').prev().find('.slick-aerrow-block'),
        });

        $('#slick-upcoming').slick({
            ...options,
            appendArrows: $('#slick-upcoming').prev().find('.slick-aerrow-block'),
        });
    </script>
@endsection