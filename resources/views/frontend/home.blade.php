@extends('layouts.frontend.app')

@section('page_css')
@endsection

@section('content')
    <body>
    <section id="home" class="iq-main-slider p-0 iq-rtl-direction">
        <div id="home-slider" class="slider m-0 p-0">
            <div class="slide slick-bg s-bg-1">
                <div class="container-fluid position-relative h-100">
                    <div class="slider-inner h-100">
                        <div class="row align-items-center h-100 iq-ltr-direction">
                            <div class="col-xl-6 col-lg-12 col-md-12">
                                <a href="javascript:void(0);">
                                    <div class="channel-logo fadeInLeft animated" data-animation-in="fadeInLeft"
                                         data-delay-in="0.5" style="opacity: 1; animation-delay: 0.5s;">
                                        <img src="frontend/images/logo-full.png" class="c-logo" alt="streamit">
                                    </div>
                                </a>
                                <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft"
                                    data-delay-in="0.6">bushland</h1>

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
                                        <span class="text-white ml-2">4.7(lmdb)</span>
                                    </div>
                                    <div class="d-flex align-items-center mt-2 mt-md-3">
                                        <span class="badge badge-secondary p-2">18+</span>
                                        <span class="ml-3">2 Seasons</span>
                                    </div>
                                </div>

                                <!-- <div class="d-flex align-items-center" data-animation-in="fadeInUp" data-delay-in="1">
                             
                             <span class="badge badge-secondary p-2">18+</span>
                             <span class="ml-3">2 Seasons</span>
                          </div> -->
                                <p data-animation-in="fadeInUp" data-delay-in="1.2">Lorem Ipsum is simply dummy text of
                                    the printing and typesetting
                                    industry. Lorem Ipsum has been the
                                    industry's standard
                                    dummy text ever since the 1500s.
                                </p>
                                <div class="trending-list" data-wp_object-in="fadeInUp" data-delay-in="1.2">
                                    <div class="text-primary title starring">
                                        Starring: <span class="text-body">Karen Gilchrist, James Earl Jones</span>
                                    </div>
                                    <div class="text-primary title genres">
                                        Genres: <span class="text-body">Action</span>
                                    </div>
                                    <div class="text-primary title tag">
                                        Tag: <span class="text-body">Action, Adventure, Horror</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp"
                                     data-delay-in="1.2">
                                    <a href="showdetails.html" class="btn btn-hover iq-button">
                                        <i class="fa fa-play mr-2"></i>
                                        Play Now
                                    </a>
                                    <a href="showdetails.html" class="btn btn-link">More details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-12 trailor-video iq-ltr-direction d-none d-lg-block">
                            <a href="video/trailer.html" class="video-open playbtn">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     x="0px" y="0px" width="80px" height="80px" viewBox="0 0 213.7 213.7"
                                     enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                             <polygon class='triangle' fill="none" stroke-width="7" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-miterlimit="10"
                                      points="73.5,62.5 148.5,105.8 73.5,149.1 "/>
                                    <circle class='circle' fill="none" stroke-width="7" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8"
                                            r="103.3"/>
                          </svg>
                                <span class="w-trailor">Watch Trailer</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide slick-bg s-bg-2">
                <div class="container-fluid position-relative h-100">
                    <div class="slider-inner h-100">
                        <div class="row align-items-center  h-100 iq-ltr-direction">
                            <div class="col-xl-6 col-lg-12 col-md-12">
                                <a href="javascript:void(0);">
                                    <div class="channel-logo" data-animation-in="fadeInLeft">
                                        <img src="frontend/images/logo-full.png" class="c-logo" alt="streamit">
                                    </div>
                                </a>
                                <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft">
                                    sail coaster</h1>

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
                                        <span class="text-white ml-2">4.7(lmdb)</span>
                                    </div>
                                    <div class="d-flex align-items-center mt-2 mt-md-3">
                                        <span class="badge badge-secondary p-2">16+</span>
                                        <span class="ml-3">2h 40m</span>
                                    </div>
                                </div>
                                <p data-animation-in="fadeInUp" data-delay-in="0.7">Lorem Ipsum is simply dummy text of
                                    the printing and typesetting
                                    industry. Lorem Ipsum has been the
                                    industry's standard
                                    dummy text ever since the 1500s.
                                </p>
                                <div class="trending-list" data-wp_object-in="fadeInUp" data-delay-in="1.2">
                                    <div class="text-primary title starring">
                                        Starring: <span class="text-body">Karen Gilchrist, James Earl Jones</span>
                                    </div>
                                    <div class="text-primary title genres">
                                        Genres: <span class="text-body">Action</span>
                                    </div>
                                    <div class="text-primary title tag">
                                        Tag: <span class="text-body">Action, Adventure, Horror</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp"
                                     data-delay-in="1">
                                    <a href="moviedetails.html" class="btn btn-hover iq-button"><i
                                                class="fa fa-play mr-2"
                                                aria-hidden="true"></i>Play Now</a>
                                    <a href="moviedetails.html" class="btn btn-link">More details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-12 trailor-video iq-ltr-direction d-none d-lg-block">
                            <a href="video/trailer.html" class="video-open playbtn">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     x="0px" y="0px" width="80px" height="80px" viewBox="0 0 213.7 213.7"
                                     enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                             <polygon class='triangle' fill="none" stroke-width="7" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-miterlimit="10"
                                      points="73.5,62.5 148.5,105.8 73.5,149.1 "/>
                                    <circle class='circle' fill="none" stroke-width="7" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8"
                                            r="103.3"/>
                          </svg>
                                <span class="w-trailor">Watch Trailer</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide slick-bg s-bg-3">
                <div class="container-fluid position-relative h-100">
                    <div class="slider-inner h-100">
                        <div class="row align-items-center  h-100 iq-ltr-direction">
                            <div class="col-xl-6 col-lg-12 col-md-12">
                                <a href="javascript:void(0);">
                                    <div class="channel-logo" data-animation-in="fadeInLeft">
                                        <img src="frontend/images/logo-full.png" class="c-logo" alt="streamit">
                                    </div>
                                </a>
                                <h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft">
                                    the army</h1>

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
                                        <span class="text-white ml-2">4.7(lmdb)</span>
                                    </div>
                                    <div class="d-flex align-items-center mt-2 mt-md-3">
                                        <span class="badge badge-secondary p-2">20+</span>
                                        <span class="ml-3">3h</span>
                                    </div>
                                </div>


                                <p data-animation-in="fadeInUp" data-delay-in="1.2" class="fadeInUp animated"
                                   style="opacity: 1; animation-delay: 1.2s;">Lorem Ipsum is simply dummy text of the
                                    printing and typesetting industry. Lorem
                                    Ipsum has been the industry's standard
                                    dummy text ever since the 1500s.
                                </p>
                                <div class="trending-list" data-wp_object-in="fadeInUp" data-delay-in="1.2">
                                    <div class="text-primary title starring">
                                        Starring: <span class="text-body">Karen Gilchrist, James Earl Jones</span>
                                    </div>
                                    <div class="text-primary title genres">
                                        Genres: <span class="text-body">Action</span>
                                    </div>
                                    <div class="text-primary title tag">
                                        Tag: <span class="text-body">Action, Adventure, Horror</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center r-mb-23" data-animation-in="fadeInUp"
                                     data-delay-in="1">
                                    <a href="moviedetails.html" class="btn btn-hover iq-button"><i
                                                class="fa fa-play mr-2"
                                                aria-hidden="true"></i>Play Now</a>
                                    <a href="moviedetails.html" class="btn btn-link">More details</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-12 col-md-12 trailor-video iq-ltr-direction d-none d-lg-block">
                            <a href="video/trailer.html" class="video-open playbtn">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     x="0px" y="0px" width="80px" height="80px" viewBox="0 0 213.7 213.7"
                                     enable-background="new 0 0 213.7 213.7" xml:space="preserve">
                             <polygon class='triangle' fill="none" stroke-width="7" stroke-linecap="round"
                                      stroke-linejoin="round" stroke-miterlimit="10"
                                      points="73.5,62.5 148.5,105.8 73.5,149.1 "/>
                                    <circle class='circle' fill="none" stroke-width="7" stroke-linecap="round"
                                            stroke-linejoin="round" stroke-miterlimit="10" cx="106.8" cy="106.8"
                                            r="103.3"/>
                          </svg>
                                <span class="w-trailor">Watch Trailer</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
            <symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 44 44" width="44px" height="44px" id="circle"
                    fill="none" stroke="currentColor">
                <circle r="20" cy="22" cx="22" id="test"></circle>
            </symbol>
        </svg>
    </section>

    <div class="main-content">
        @auth
            <section id="section-welcome" class="mt-2 mb-4">
                <div class="container d-flex align-items-center justify-content-center">
                    <img src="{{ asset('frontend/images/welcome.png') }}" alt="" class="mr-5">
                    <p style="font-size: 41px;" class="m-0">Welcome {{ auth()->user()->name }}</p>
                </div>
            </section>
        @endauth

        <section id="section-continue-watching">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Continue Watching</h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex slick-aerrow-block"></div>
                                <a href="{{ route('frontend.watches.index') }}" class="ml-3 cursor-pointer">
                                    View all <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="favorites-contens">
                            @if(isset($watches) && $watches->isNotEmpty())
                                <ul id="slick-continue-watching"
                                    class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                    @foreach($watches as $watch)
                                        <li class="slide-item">
                                            <div class="block-images position-relative">
                                                <div class="img-box">
                                                    <img data-lazy="{{ getPoster($watch->watchable) }}"
                                                         class="img-fluid">
                                                </div>
                                                <div class="block-description">
                                                    <h6 class="iq-title">
                                                        <a href="{{ getRoute($watch->watchable) . '?t=' . $watch->current_time }}">{{ $watch->watchable->title }}</a>
                                                    </h6>
                                                    <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                        <div class="badge badge-secondary p-1 mr-2">{{ $watch->watchable->content_rating }}
                                                            +
                                                        </div>
                                                        <span class="text-white">{{ getDuration($watch->watchable) }}</span>
                                                    </div>
                                                    <div class="hover-buttons">
                                                        <a href="{{ getRoute($watch->watchable) . '?t=' . $watch->current_time }}"
                                                           class="btn btn-hover iq-button">
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
        <section id="section-board">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Board</h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex slick-aerrow-block"></div>
                                <a href="{{ route('frontend.board.index') }}" class="ml-3 cursor-pointer">View all <i
                                            class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="favorites-contens">
                            @if(isset($board) && $board->isNotEmpty())
                                <ul id="slick-board" class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                    @foreach($board as $item)
                                        <li class="slide-item">
                                            <div class="block-images position-relative">
                                                <div class="img-box">
                                                    <img data-lazy="{{ getPoster($item->myListable) }}"
                                                         class="img-fluid">
                                                </div>
                                                <div class="block-description">
                                                    <h6 class="iq-title">
                                                        <a href="{{ getRoute($item->myListable) }}">{{ $item->myListable->title }}</a>
                                                    </h6>
                                                    <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                        <div class="badge badge-secondary p-1 mr-2">{{ $item->myListable->content_rating }}
                                                            +
                                                        </div>
                                                        <span class="text-white">{{ getDuration($item->myListable) }}</span>
                                                    </div>
                                                    <div class="hover-buttons">
                                                        <a href="{{ getRoute($item->myListable) }}"
                                                           class="btn btn-hover iq-button">
                                                            <i class="fa fa-play mr-1"></i>
                                                            Play Now
                                                        </a>
                                                    </div>
                                                </div>
                                                @include('frontend.social', ['resource' => $item->myListable])
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
        <section id="section-history">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">History</h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex slick-aerrow-block"></div>
                                <a href="{{ route('frontend.history.index') }}" class="ml-3 cursor-pointer">View all <i
                                            class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="favorites-contens">
                            @if(isset($histories) && $histories->isNotEmpty())
                                <ul id="slick-history"
                                    class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                    @foreach($histories as $history)
                                        <li class="slide-item">
                                            <div class="block-images position-relative">
                                                <div class="img-box">
                                                    <img data-lazy="{{ getPoster($history->visitable) }}"
                                                         class="img-fluid">
                                                </div>
                                                <div class="block-description">
                                                    <h6 class="iq-title">
                                                        <a href="{{ getRoute($history->visitable) }}">{{ $history->visitable->title }}</a>
                                                    </h6>
                                                    <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                        <div class="badge badge-secondary p-1 mr-2">{{ $history->visitable->content_rating }}
                                                            +
                                                        </div>
                                                        <span class="text-white">{{ getDuration($history->visitable) }}</span>
                                                    </div>
                                                    <div class="hover-buttons">
                                                        <a href="{{ getRoute($history->visitable) }}"
                                                           class="btn btn-hover iq-button">
                                                            <i class="fa fa-play mr-1" aria-hidden="true"></i>
                                                            Play Now
                                                        </a>
                                                    </div>
                                                </div>
                                                @include('frontend.social', ['resource' => $history->visitable])
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
                            <div class="d-flex align-items-center">
                                <div class="d-flex slick-aerrow-block"></div>
                                <a href="{{ route('frontend.recommended.index') }}" class="ml-3 cursor-pointer">
                                    View all <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="favorites-contens">
                            @if(isset($recommended) && $recommended->isNotEmpty())
                                <ul id="slick-recommended"
                                    class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                    @foreach($recommended as $item)
                                        <li class="slide-item">
                                            <div class="block-images position-relative">
                                                <div class="img-box">
                                                    <img src="{{ getPoster($item) }}" class="img-fluid">
                                                </div>
                                                <div class="block-description">
                                                    <h6 class="iq-title">
                                                        <a href="{{ getRoute($item) }}">{{ $item->title }}</a>
                                                    </h6>
                                                    <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                        <div class="badge badge-secondary p-1 mr-2">{{ $item->content_rating }}
                                                            +
                                                        </div>
                                                        <span class="text-white">{{ getDuration($item) }}</span>
                                                    </div>
                                                    <div class="hover-buttons">
                                                        <a href="{{ getRoute($item) }}" class="btn btn-hover iq-button">
                                                            <i class="fa fa-play mr-1"></i>
                                                            Play Now
                                                        </a>
                                                    </div>
                                                </div>
                                                @include('frontend.social', ['resource' => $item])
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
                            <a href="{{ route('frontend.trending.index') }}" class="ml-3 cursor-pointer">
                                View all <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                        <div class="favorites-contens">
                            @if(isset($trending) && $trending->isNotEmpty())
                                <ul id="slick-trending"
                                    class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
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
                                                        <div class="badge badge-secondary p-1 mr-2">
                                                            {{ $item->visitable->content_rating }}+
                                                        </div>
                                                        <span class="text-white">{{ getDuration($item->visitable) }}</span>
                                                    </div>
                                                    <div class="hover-buttons">
                                                        <a href="{{ getRoute($item->visitable) }}"
                                                           class="btn btn-hover iq-button">
                                                            <i class="fa fa-play mr-1"></i>
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
        <section id="section-channels">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Channels</h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex slick-aerrow-block"></div>
                                <a href="{{ route('frontend.channels.index') }}" class="ml-3 cursor-pointer">
                                    View all <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="favorites-contens">
                            @if(isset($channels) && $channels->isNotEmpty())
                                <ul id="slick-channels" class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                    @foreach($channels as $channel)
                                        <li class="slide-item w-auto">
                                            <a href="{{ route('frontend.channels.show', $channel->id) }}"
                                               class="rounded-circle bg-white d-flex"
                                               style="height: 100px;width: 100px;">
                                                <img src="{{ asset("storage/{$channel->logo}") }}"
                                                     class="my-auto mx-auto" width="48">
                                            </a>
                                            <div class="mt-2 text-center text-capitalize">{{ $channel->title }}</div>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <div>No Channel found</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="section-premiums">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Premiums</h4>
                            <div class="d-flex slick-aerrow-block"></div>
                        </div>
                        <div class="favorites-contens">
                            @if(isset($movies) && $movies->isNotEmpty())
                                <ul id="slick-premiums"
                                    class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                    @foreach($movies as $movie)
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

        <section id="section-live">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Live</h4>
                            <div class="d-flex slick-aerrow-block"></div>
                        </div>
                        <div class="favorites-contens">
                            @if(isset($lives) && $lives->isNotEmpty())
                                <ul id="slick-live" class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                    @foreach($lives as $live)
                                        <li class="slide-item">
                                            <div class="block-images position-relative">
                                                <div class="img-box">
                                                    <img data-lazy="{{ getPoster($live) }}" class="img-fluid"></div>
                                                <div class="block-description">
                                                    <h6 class="iq-title">
                                                        <a href="{{ getRoute($live) }}">{{ $live->title }}</a>
                                                    </h6>
                                                    <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                        <div class="badge badge-secondary p-1 mr-2">{{ $live->content_rating }}
                                                            +
                                                        </div>
                                                    </div>
                                                    <div class="hover-buttons">
                                                        <a href="{{ getRoute($live) }}" class="btn btn-hover iq-button">
                                                            <i class="fa fa-play mr-1"></i>
                                                            Play Now
                                                        </a>
                                                    </div>
                                                </div>
                                                @include('frontend.social', ['resource' => $live])
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
        <section id="section-shows">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Shows</h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex slick-aerrow-block"></div>
                                <a href="{{ route('frontend.shows.index') }}" class="ml-3 cursor-pointer">View all <i
                                            class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="favorites-contens">
                            @if(isset($shows) && $shows->isNotEmpty())
                                <ul id="slick-shows"
                                    class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                    @foreach($shows as $show)
                                        <li class="slide-item">
                                            <div class="block-images position-relative">
                                                <div class="img-box">
                                                    <img data-lazy="{{ getPoster($show) }}" class="img-fluid"></div>
                                                <div class="block-description">
                                                    <h6 class="iq-title">
                                                        <a href="{{ getRoute($show) }}">{{ $show->title }}</a>
                                                    </h6>
                                                    <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                        <div class="badge badge-secondary p-1 mr-2">
                                                            {{ $show->content_rating }} +
                                                        </div>
                                                        <div class="text-white">{{ getDuration($show) }}</div>
                                                    </div>
                                                    <div class="hover-buttons">
                                                        <a href="{{ getRoute($show) }}" class="btn btn-hover iq-button">
                                                            <i class="fa fa-play mr-1"></i>
                                                            Play Now
                                                        </a>
                                                    </div>
                                                </div>
                                                @include('frontend.social', ['resource' => $show])
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
        <section id="section-movies">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12 overflow-hidden">
                        <div class="iq-main-header d-flex align-items-center justify-content-between">
                            <h4 class="main-title">Movies</h4>
                            <div class="d-flex align-items-center">
                                <div class="d-flex slick-aerrow-block"></div>
                                <a href="{{ route('frontend.movies.index') }}" class="ml-3 cursor-pointer">
                                    View all <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="favorites-contens">
                            @if(isset($movies) && $movies->isNotEmpty())
                                <ul id="slick-movies"
                                    class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
                                    @foreach($movies as $item)
                                        <li class="slide-item">
                                            <div class="block-images position-relative">
                                                <div class="img-box">
                                                    <img data-lazy="{{ getPoster($item) }}" class="img-fluid">
                                                </div>
                                                <div class="block-description">
                                                    <h6 class="iq-title">
                                                        <a href="{{ getRoute($item) }}">{{ $item->title }}</a>
                                                    </h6>
                                                    <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                                        <div class="badge badge-secondary p-1 mr-2">
                                                            {{ $item->content_rating }} +
                                                        </div>
                                                        <div class="text-white">{{ getDuration($item) }}</div>
                                                    </div>
                                                    <div class="hover-buttons">
                                                        <a href="{{ getRoute($item) }}" class="btn btn-hover iq-button">
                                                            <i class="fa fa-play mr-1"></i>
                                                            Play Now
                                                        </a>
                                                    </div>
                                                </div>
                                                @include('frontend.social', ['resource' => $item])
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
    </div>

    <div id="back-to-top">
        <a class="top" href="#top" id="top"> <i class="fa fa-angle-up"></i> </a>
    </div>
    </body>
@endsection

@section('page_js')
    <script>
        /*---------------------------------------------------------------------
			Slick Slider
		----------------------------------------------------------------------- */
        $('#home-slider').slick({
            autoplay: false,
            speed: 800,
            lazyLoad: 'progressive',
            arrows: true,
            dots: false,
            prevArrow: '<div class="slick-nav prev-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
            nextArrow: '<div class="slick-nav next-arrow"><i></i><svg><use xlink:href="#circle"></svg></div>',
            responsive: [
                {
                    breakpoint: 992,
                    settings: {
                        dots: true,
                        arrows: false,
                    }
                }
            ]
        });

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

        $('#slick-continue-watching').slick({
            ...options,
            appendArrows: $('#slick-continue-watching').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-history').slick({
            ...options,
            appendArrows: $('#slick-history').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-board').slick({
            ...options,
            appendArrows: $('#slick-board').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-recommended').slick({
            ...options,
            appendArrows: $('#slick-recommended').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-trending').slick({
            ...options,
            appendArrows: $('#slick-trending').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-channels').slick({
            ...options,
            slidesToShow: 10,
            appendArrows: $('#slick-channels').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-premiums').slick({
            ...options,
            appendArrows: $('#slick-premiums').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-live').slick({
            ...options,
            appendArrows: $('#slick-live').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-sports').slick({
            ...options,
            appendArrows: $('#slick-sports').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-shows').slick({
            ...options,
            appendArrows: $('#slick-shows').parent().prev().find('.slick-aerrow-block'),
        });

        $('#slick-movies').slick({
            ...options,
            appendArrows: $('#slick-movies').parent().prev().find('.slick-aerrow-block'),
        });

        $('#episodes-slider2').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 300,
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });
        $('#episodes-slider3').slick({
            dots: false,
            arrows: true,
            infinite: true,
            rtl: false,
            speed: 300,
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        infinite: true,
                        dots: true,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                }
            ]
        });

        // $('#trending-slider').slick({
        //     slidesToShow: 1,
        //     slidesToScroll: 1,
        //     arrows: false,
        //     fade: true,
        //     draggable: false,
        //     asNavFor: '#trending-slider-nav',
        // });
        //
        // $('#trending-slider-nav').slick({
        //     slidesToShow: 5,
        //     slidesToScroll: 1,
        //     asNavFor: '#trending-slider',
        //     dots: false,
        //     arrows: true,
        //     nextArrow: '<a href="#" class="slick-arrow slick-next"><i class= "fa fa-chevron-right"></i></a>',
        //     prevArrow: '<a href="#" class="slick-arrow slick-prev"><i class= "fa fa-chevron-left"></i></a>',
        //     infinite: true,
        //     centerMode: true,
        //     centerPadding: 0,
        //     focusOnSelect: true,
        //     responsive: [
        //         {
        //             breakpoint: 1024,
        //             settings: {
        //                 slidesToShow: 2,
        //                 slidesToScroll: 1,
        //             }
        //         },
        //         {
        //             breakpoint: 600,
        //             settings: {
        //                 slidesToShow: 1,
        //                 slidesToScroll: 1
        //             }
        //         }
        //     ]
        // });

        // $('#tvshows-slider').slick({
        //     centerMode: true,
        //     centerPadding: '200px',
        //     slidesToShow: 1,
        //     nextArrow: '<button class="NextArrow"><i class="ri-arrow-right-s-line"></i></button>',
        //     prevArrow: '<button class="PreArrow"><i class="ri-arrow-left-s-line"></i></button>',
        //     arrows: true,
        //     dots: false,
        //     responsive: [
        //         {
        //             breakpoint: 991,
        //             settings: {
        //                 arrows: false,
        //                 centerMode: true,
        //                 centerPadding: '20px',
        //                 slidesToShow: 1
        //             }
        //         },
        //         {
        //             breakpoint: 480,
        //             settings: {
        //                 arrows: false,
        //                 centerMode: true,
        //                 centerPadding: '20px',
        //                 slidesToShow: 1
        //             }
        //         }
        //     ]
        // });
        //
        /*---------------------------------------------------------------------
            Owl Carousel
        ----------------------------------------------------------------------- */
        $('.episodes-slider1').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            navText: ["<i class='ri-arrow-left-s-line'></i>", "<i class='ri-arrow-right-s-line'></i>"],
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 4
                }
            }
        });

        $('.season-select').on('change', (e) => {
            const value = $(this).val();
            $('.episodes-contens').find('ul').addClass('d-none');
            $('.episodes-contens').find('.' + value).removeClass('d-none');
        });

        $('.btn-favorite').on('click', (e) => {
            const btn = $(e.currentTarget);
            const id = btn.attr('data-id');
            const type = btn.attr('data-type');

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "POST",
                dataType: "json",
                url: "{{ route('frontend.favorites.store') }}",
                data: {
                    id: id,
                    type: type,
                },
                success: function (response) {
                    if (response.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            timer: 1500,
                            icon: 'success',
                            position: 'top-end',
                            toast: true,
                            showConfirmButton: false
                        });

                        btn.toggleClass('active');
                    }
                },
            });
        });

        $('.btn-list').on('click', (e) => {
            const btn = $(e.currentTarget);
            const id = btn.attr('data-id');
            const type = btn.attr('data-type');

            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                method: "POST",
                dataType: "json",
                url: "{{ route('frontend.my_list.store') }}",
                data: {
                    id: id,
                    type: type,
                },
                success: function (response) {
                    if (response.status) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            timer: 1500,
                            icon: 'success',
                            position: 'top-end',
                            toast: true,
                            showConfirmButton: false
                        });

                        btn.toggleClass('active');
                    }
                },
            });
        });
    </script>
@endsection