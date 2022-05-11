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
                <video id="main-player" class="video-js vjs-default-skin" controls preload="metadata"
                       style="width: 100%; height: 360px;" poster="{{ getPoster($sport) }}">
                    @if(isSubscribed($sport))
                        @foreach(getVideos($sport) as $media)
                            <source src="{{ asset('private/media/'.$media->id) }}" type="{{ $media->type }}"
                                    label="{{ $media->pivot->type }}" @if($loop->first) selected="true" @endif>
                        @endforeach
                    @else
                        <source src="{{ getTrailerPath($sport) }}" type="{{ getTrailerType($sport) }}" label="Auto"
                                selected="true">
                    @endif
                </video>
            </section>
            <section id="section-info">
                <ul class="d-flex align-items-center text-white p-0" style="list-style: none">
                    @foreach($sport->genres as $genre)
                        <li class="pr-1"><a href="{{ route('frontend.genres.show', $genre->id) }}">#{{ $genre->name }}</a></li>
                    @endforeach
                </ul>
                <h4 class="text-uppercase mb-2">{{ $sport->title }}</h4>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <ul class="list-inline d-flex align-items-center movie-content m-0">
                            <li class="text-white">{{ $views }} views</li>
                            <li class="text-white">{{ $sport->created_at->format('M d, Y') }}</li>
                        </ul>
                        <div class="text-white">
                            <i class="fa fa-clock-o mr-1"></i>
                            {{ getDuration($sport) }}
                        </div>
                    </div>
                    <div>
                        <button class="btn-like btn btn-sm btn-success p-1 px-2" data-id="{{ $sport->id }}">
                            <i class="fa fa-thumbs-up"></i>
                            <span class="likes-count">{{ $likes }}</span>
                        </button>
                        <button class="btn-dislike btn btn-sm btn-secondary p-1 px-2" data-id="{{ $sport->id }}">
                            <i class="fa fa-thumbs-down"></i>
                            <span class="dislikes-count">{{ $dislikes }}</span>
                        </button>
                    </div>
                </div>

                <section class="py-3 my-3 border-top border-bottom">
                    <div class="row align-items-center mx-0 mb-3">
                        <div class="col-2 text-center">
                            <img src="{{ asset("storage/{$sport->channel->logo}") }}" width="48">
                        </div>
                        <div class="col-7 pl-0">
                            <a href="{{ route('frontend.channels.show', $sport->channel->id) }}" style="font-size: 1rem;line-height: normal;">{{ $sport->channel->title }}</a>
                            <div style="font-size: 0.8rem;line-height: normal">
                                {{ $sport->channel()->first()->subscribers()->count() }}
                                <span class="ml-1">subscribers</span>
                            </div>
                        </div>
                        <div class="col-3">
                            @if(isSubscribed($sport))
                                <button class="btn btn-danger disabled" disabled><i class="fas fa-bell mr-1"></i> Subscribed</button>
                            @else
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary btn-block" data-toggle="dropdown">
                                        Subscribe
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item cursor-pointer" data-toggle="modal" data-target="#subscription-modal" data-action="{{ route('frontend.channels.subscribe', $sport->channel->id) }}" data-price="{{ $sport->channel->subscription_price_without_ads }}" data-type="without_ads">Without Ads (${{ $sport->channel->subscription_price_without_ads }})</button>
                                        <button class="dropdown-item cursor-pointer" data-toggle="modal" data-target="#subscription-modal" data-action="{{ route('frontend.channels.subscribe', $sport->channel->id) }}" data-price="{{ $sport->channel->subscription_price_with_ads }}" data-type="with_ads">With Ads (${{ $sport->channel->subscription_price_with_ads }})</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row align-items-center mx-0">
                        <div class="col-2"></div>
                        <div class="col-10 pl-0 description w-100 mb-0" style="font-size: 16px;">
                            {!! $sport->description !!}
                        </div>
                    </div>
                </section>

                <ul class="list-inline p-0 mt-4 share-icons music-play-lists">
                    <li><span><i class="ri-add-line"></i></span></li>
                    <li><span><i class="ri-heart-fill"></i></span></li>
                    <li class="share">
                        <span><i class="ri-share-fill"></i></span>
                        <div class="share-box">
                            <div class="d-flex align-items-center">
                                <a href="#" class="share-ico"><i class="ri-facebook-fill"></i></a>
                                <a href="#" class="share-ico"><i class="ri-twitter-fill"></i></a>
                                <a href="#" class="share-ico"><i class="ri-links-fill"></i></a>
                            </div>
                        </div>
                    </li>
                </ul>
            </section>
{{--            <section id="section-info">--}}
{{--                <ul class="d-flex align-items-center text-white p-0" style="list-style: none">--}}
{{--                    @foreach($sport->genres as $genre)--}}
{{--                        <li class="pr-1"><a href="">#{{ $genre->name }}</a></li>--}}
{{--                    @endforeach--}}
{{--                </ul>--}}
{{--                <h4 class="text-uppercase mb-2">{{ $sport->title }}</h4>--}}
{{--                <div class="d-flex justify-content-between align-items-center">--}}
{{--                    <div>--}}
{{--                        <ul class="list-inline d-flex align-items-center movie-content m-0">--}}
{{--                            <li class="text-white">{{ $views }} views</li>--}}
{{--                            <li class="text-white">{{ $sport->created_at->format('M d, Y') }}</li>--}}
{{--                        </ul>--}}
{{--                        <div class="text-white">--}}
{{--                            <i class="fa fa-clock-o mr-1"></i>--}}
{{--                            {{ getDuration($sport) }}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div>--}}
{{--                        <button class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-thumbs-up"></i> 335</button>--}}
{{--                        <button class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-thumbs-down"></i> 99</button>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--                <div class="d-flex align-items-center series mb-4">--}}
{{--                    <img src="{{asset('frontend/images/trending/trending-label.png')}}" class="img-fluid">--}}
{{--                    <span class="text-gold ml-3">#2 in Series Today</span>--}}
{{--                </div>--}}
{{--                <div class="description w-100 mb-0" style="font-size: 16px;">--}}
{{--                    {!! $sport->description !!}--}}
{{--                </div>--}}
{{--                <ul class="list-inline p-0 mt-4 share-icons music-play-lists">--}}
{{--                    <li><span><i class="ri-add-line"></i></span></li>--}}
{{--                    <li><span><i class="ri-heart-fill"></i></span></li>--}}
{{--                    <li class="share">--}}
{{--                        <span><i class="ri-share-fill"></i></span>--}}
{{--                        <div class="share-box">--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <a href="#" class="share-ico"><i class="ri-facebook-fill"></i></a>--}}
{{--                                <a href="#" class="share-ico"><i class="ri-twitter-fill"></i></a>--}}
{{--                                <a href="#" class="share-ico"><i class="ri-links-fill"></i></a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </section>--}}
        </div>
        <div class="col col-lg-4">
            <ul class="list-group p-0">
                <li class="d-flex p-0 mb-2">
                    <a href="#!">
                        <img src="{{ getPoster($sport) }}" style="width: 150px;height: 90px;"/>
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
    <section id="section-similar" class="mb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 overflow-hidden">
                    <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">More Like This</h4>
                        <div class="d-flex slick-aerrow-block"></div>
                    </div>
                    <div class="favorites-contens">
                        @if(isset($latest_movies) && $latest_movies->isNotEmpty())
                            <ul id="slick-more"
                                class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                @foreach($latest_movies as $movie)
                                    <li class="slide-item">
                                        <div class="block-images position-relative">
                                            <div class="img-box"><img
                                                        data-lazy="{{ asset('storage/'.$movie->thumbnail) }}"
                                                        class="img-fluid"></div>
                                            <div class="block-description">
                                                <h6 class="iq-title"><a
                                                            href="{{ route('frontend.movies.show', [$movie->id, $movie->title]) }}">{{ $movie->title }}</a>
                                                </h6>
                                                <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                    <div class="badge badge-secondary p-1 mr-2">{{ $movie->age }}+
                                                    </div>
                                                    <span class="text-white">{{ \Carbon\CarbonInterval::seconds($movie->duration)->cascade()->forHumans() }}</span>
                                                </div>
                                                <div class="hover-buttons">
													<span class="btn btn-hover iq-button">
														<i class="fa fa-play mr-1" aria-hidden="true"></i>
														Play Now
													</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li class="share">
                                                        <span><i class="ri-share-fill"></i></span>
                                                        <div class="share-box">
                                                            <div class="d-flex align-items-center">
                                                                <a href="https://www.facebook.com/sharer?u=https://iqonic.design/wp-themes/streamit_wp/movie/shadow/"
                                                                   target="_blank" rel="noopener noreferrer"
                                                                   class="share-ico" tabindex="0"><i
                                                                            class="ri-facebook-fill"></i></a>
                                                                <a href="https://twitter.com/intent/tweet?text=Currentlyreading"
                                                                   target="_blank" rel="noopener noreferrer"
                                                                   class="share-ico" tabindex="0"><i
                                                                            class="ri-twitter-fill"></i></a>
                                                                <a href="#"
                                                                   data-link="https://iqonic.design/wp-themes/streamit_wp/movie/shadow/"
                                                                   class="share-ico iq-copy-link" tabindex="0"><i
                                                                            class="ri-links-fill"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <span><i class="ri-heart-fill"></i></span>
                                                        <span class="count-box">{{ $movie->content_rating }}+</span>
                                                    </li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div>No resource found</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-upcoming" class="mb-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 overflow-hidden">
                    <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">Upcoming Episodes</h4>
                        <div class="d-flex slick-aerrow-block"></div>
                    </div>
                    <div class="favorites-contens">
                        @if(isset($upcomings) && $upcomings->isNotEmpty())
                            <ul id="slick-upcoming" class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                @foreach($upcomings as $movie)
                                    <li class="slide-item">
                                        <div class="block-images position-relative">
                                            <div class="img-box"><img
                                                        data-lazy="{{ asset('storage/'.$movie->thumbnail) }}"
                                                        class="img-fluid"></div>
                                            <div class="block-description">
                                                <h6 class="iq-title"><a
                                                            href="{{ route('frontend.movies.show', $movie->id) }}">{{ $movie->title }}</a>
                                                </h6>
                                                <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                    <div class="badge badge-secondary p-1 mr-2">{{ $movie->age }}+
                                                    </div>
                                                    <span class="text-white">{{ \Carbon\CarbonInterval::seconds($movie->duration)->cascade()->forHumans() }}</span>
                                                </div>
                                                <div class="hover-buttons">
													<span class="btn btn-hover iq-button">
														<i class="fa fa-play mr-1" aria-hidden="true"></i>
														Play Now
													</span>
                                                </div>
                                            </div>
                                            <div class="block-social-info">
                                                <ul class="list-inline p-0 m-0 music-play-lists">
                                                    <li class="share">
                                                        <span><i class="ri-share-fill"></i></span>
                                                        <div class="share-box">
                                                            <div class="d-flex align-items-center">
                                                                <a href="https://www.facebook.com/sharer?u=https://iqonic.design/wp-themes/streamit_wp/movie/shadow/"
                                                                   target="_blank" rel="noopener noreferrer"
                                                                   class="share-ico" tabindex="0"><i
                                                                            class="ri-facebook-fill"></i></a>
                                                                <a href="https://twitter.com/intent/tweet?text=Currentlyreading"
                                                                   target="_blank" rel="noopener noreferrer"
                                                                   class="share-ico" tabindex="0"><i
                                                                            class="ri-twitter-fill"></i></a>
                                                                <a href="#"
                                                                   data-link="https://iqonic.design/wp-themes/streamit_wp/movie/shadow/"
                                                                   class="share-ico iq-copy-link" tabindex="0"><i
                                                                            class="ri-links-fill"></i></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <span><i class="ri-heart-fill"></i></span>
                                                        <span class="count-box">{{ $movie->content_rating }}+</span>
                                                    </li>
                                                    <li><span><i class="ri-add-line"></i></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <div>No resource found</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('page_js')
    <script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
    <script src="https://unpkg.com/@silvermine/videojs-quality-selector/dist/js/silvermine-videojs-quality-selector.min.js"></script>
    <script src="{{ asset('js/VideoPlayer.js') }}"></script>
    <script>
        $(window).on('load', (e) => {
            new VideoPlayer({
                currentTime: @if(request()->has('t')) {{ request()->input('t') }} @endif,
                routes: {
                    watch: "{{ route('frontend.watch.store') }}",
                    like: "{{ route('frontend.sports.like') }}",
                    dislike: "{{ route('frontend.sports.dislike') }}"
                },
                watchLog: {
                    id: {{ $sport->id }},
                    type: "{{ urlencode(get_class($sport)) }}"
                }
            });

            const options = {
                lazyLoad: 'ondemand',
                dots: false,
                arrows: true,
                infinite: true,
                speed: 300,
                autoplay: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                nextArrow: '<button class="slick-arrow slick-next"><i class="fa fa-chevron-right"></i></button>',
                prevArrow: '<button class="slick-arrow slick-prev"><i class="fa fa-chevron-left"></i></button>',
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
                            infinite: true,
                            dots: true
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
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
                appendArrows: $('#slick-similar').parent().prev().find('.slick-aerrow-block'),
            });

            $('#slick-episodes').slick({
                ...options,
                appendArrows: $('#slick-episodes').parent().prev().find('.slick-aerrow-block'),
            });
        });
    </script>
@endsection