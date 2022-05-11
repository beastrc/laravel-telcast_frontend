@extends('layouts.frontend.app')

@section('page_css')
@endsection

@section('content')
    <section id="home" class="iq-main-slider p-0 iq-rtl-direction">
        <div id="home-slider" class="slider m-0 p-0">
            <div class="slide slick-bg s-bg-1">
                <div class="container-fluid position-relative h-100">
                    <div class="slider-inner h-100">
                        <img src="{{ asset("storage/{$channel->logo}") }}" class="c-logo">
                        <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft" data-delay-in="0.6">{{ $channel->title }}</h1>

                        <div class="d-flex flex-wrap align-items-center fadeInLeft animated"
                             data-animation-in="fadeInLeft" style="opacity: 1;">
                            <div class="slider-ratting d-flex align-items-center mr-4 mt-2 mt-md-3">
                                <ul class="ratting-start p-0 m-0 list-inline text-primary d-flex align-items-center justify-content-left">
                                    <li>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    </li>
                                    <li>
                                        <i class="fa fa-star-half" aria-hidden="true"></i>
                                    </li>
                                </ul>
                                <span class="text-white ml-2">4.7 (based on content)</span>
                            </div>
                            <div class="d-flex align-items-center mt-2 mt-md-3">
                                <span class="badge badge-secondary p-2">12 Contents</span>
                            </div>
                        </div>
                        <p data-animation-in="fadeInUp" data-delay-in="1.2">
                            Lorem Ipsum is simply dummy text of
                            the printing and typesetting
                            industry. Lorem Ipsum has been the
                            industry's standard
                            dummy text ever since the 1500s.
                        </p>
                        <div class="d-flex">
                            @if(userHasSubscribed($channel->id))
                                <button class="btn btn-danger disabled" disabled><i class="fas fa-bell mr-1"></i> Subscribed</button>
                            @else
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" data-toggle="dropdown">
                                        Subscribe
                                    </button>
                                    <div class="dropdown-menu my-1 rounded-0">
                                        <button class="dropdown-item cursor-pointer" data-toggle="modal" data-target="#subscription-modal" data-action="{{ route('frontend.channels.subscribe', $channel->id) }}" data-price="{{ $channel->subscription_price_without_ads }}" data-type="without_ads">Without Ads (${{ $channel->subscription_price_without_ads }})</button>
                                        <button class="dropdown-item cursor-pointer" data-toggle="modal" data-target="#subscription-modal" data-action="{{ route('frontend.channels.subscribe', $channel->id) }}" data-price="{{ $channel->subscription_price_with_ads }}" data-type="with_ads">With Ads (${{ $channel->subscription_price_with_ads }})</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="section-spotlights">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 overflow-hidden">
                    <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">Spotlights</h4>
                        <div class="d-flex slick-aerrow-block"></div>
                    </div>
                    <div class="favorites-contens">
                        @if(isset($spotlights) && $spotlights->isNotEmpty())
                            <ul id="slick-spotlights" class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                @foreach($spotlights as $spotlight)
                                    <li class="slide-item">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img data-lazy="{{ getPoster($spotlight->spotlightable) }}"
                                                     class="img-fluid">
                                            </div>
                                            <div class="block-description">
                                                <h6 class="iq-title">
                                                    <a href="{{ getRoute($spotlight->spotlightable) }}">{{ $spotlight->spotlightable->title }}</a>
                                                </h6>
                                                <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                    <div class="badge badge-secondary p-1 mr-2">
                                                        {{ $spotlight->spotlightable->content_rating }} +
                                                    </div>
                                                    <span class="text-white">{{ getDuration($spotlight->spotlightable) }}</span>
                                                </div>
                                                <div class="hover-buttons">
													<a href="{{ getRoute($spotlight->spotlightable) }}" class="btn btn-hover iq-button">
														<i class="fa fa-play mr-1" aria-hidden="true"></i>
														Play Now
													</a>
                                                </div>
                                            </div>
                                            @include('frontend.social', ['resource' => $spotlight->spotlightable])
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
    <section id="section-continue-watching">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 overflow-hidden">
                    <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">Continue Watching</h4>
                        <div class="d-flex slick-aerrow-block"></div>
                    </div>
                    <div class="favorites-contens">
                        @if(isset($watches) && $watches->isNotEmpty())
                            <ul id="slick-continue-watching" class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                @foreach($watches as $watch)
                                    <li class="slide-item">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img data-lazy="{{ getPoster($watch->watchable) }}"
                                                     class="img-fluid">
                                            </div>
                                            <div class="block-description">
                                                <h6 class="iq-title">
                                                    <a href="{{ getRoute($watch->watchable) }}?t={{ $watch->current_time }}">{{ $watch->watchable->title }}</a>
                                                </h6>
                                                <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                    <div class="badge badge-secondary p-1 mr-2">
                                                        {{ $watch->watchable->content_rating }} +
                                                    </div>
                                                    <span class="text-white">{{ getDuration($watch->watchable) }}</span>
                                                </div>
                                                <div class="hover-buttons">
													<a href="{{ getRoute($watch->watchable) }}?t={{ $watch->current_time }}" class="btn btn-hover iq-button">
														<i class="fa fa-play mr-1" aria-hidden="true"></i>
														Play Now
													</a>
                                                </div>
                                            </div>
                                            @include('frontend.social', ['resource' => $watch->watchable])
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
    <section id="section-recommended">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 overflow-hidden">
                    <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">Recommended</h4>
                        <div class="d-flex slick-aerrow-block"></div>
                    </div>
                    <div class="favorites-contens">
                        @if(isset($recommended) && $recommended->isNotEmpty())
                            <ul id="slick-recommended" class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                @foreach($recommended as $item)
                                    <li class="slide-item">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img data-lazy="{{ getPoster($item->likeable) }}"
                                                     class="img-fluid">
                                            </div>
                                            <div class="block-description">
                                                <h6 class="iq-title">
                                                    <a href="{{ getRoute($item->likeable) }}">{{ $item->likeable->title }}</a>
                                                </h6>
                                                <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                    <div class="badge badge-secondary p-1 mr-2">{{ $item->likeable->content_rating }}
                                                        +
                                                    </div>
                                                    <span class="text-white">{{ getDuration($item->likeable) }}</span>
                                                </div>
                                                <div class="hover-buttons">
													<a href="{{ getRoute($item->likeable) }}" class="btn btn-hover iq-button">
														<i class="fa fa-play mr-1" aria-hidden="true"></i>
														Play Now
													</a>
                                                </div>
                                            </div>
                                            @include('frontend.social', ['resource' => $item->likeable])
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
    <section id="section-trending">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 overflow-hidden">
                    <div class="iq-main-header d-flex align-items-center justify-content-between">
                        <h4 class="main-title">Trending</h4>
                        <div class="d-flex slick-aerrow-block"></div>
                    </div>
                    <div class="favorites-contens">
                        @if(isset($trending) && $trending->isNotEmpty())
                            <ul id="slick-trending" class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                @foreach($trending as $item)
                                    <li class="slide-item">
                                        <div class="block-images position-relative">
                                            <div class="img-box">
                                                <img data-lazy="{{ getPoster($item->visitable) }}"
                                                     class="img-fluid">
                                            </div>
                                            <div class="block-description">
                                                <h6 class="iq-title">
                                                    <a href="{{ getRoute($item->visitable) }}">{{ $item->visitable->title }}</a>
                                                </h6>
                                                <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                    <div class="badge badge-secondary p-1 mr-2">{{ $item->visitable->content_rating }}
                                                        +
                                                    </div>
                                                    <span class="text-white">{{ getDuration($item->visitable) }}</span>
                                                </div>
                                                <div class="hover-buttons">
													<a href="{{ getRoute($item->visitable) }}" class="btn btn-hover iq-button">
														<i class="fa fa-play mr-1" aria-hidden="true"></i>
														Play Now
													</a>
                                                </div>
                                            </div>
                                            @include('frontend.social', ['resource' => $item->visitable])
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
    <script>
        const options = {
            lazyLoad: 'ondemand',
            dots: false,
            arrows: true,
            infinite: true,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 2000,
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

        $('#slick-spotlights').slick({
            ...options,
            appendArrows: $('#slick-spotlights').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-continue-watching').slick({
            ...options,
            appendArrows: $('#slick-continue-watching').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-recommended').slick({
            ...options,
            appendArrows: $('#slick-recommended').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-trending').slick({
            ...options,
            appendArrows: $('#slick-trending').parent().prev().find('.slick-aerrow-block'),
        });
    </script>
@endsection