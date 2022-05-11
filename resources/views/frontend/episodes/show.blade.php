@extends('layouts.frontend.app')

@section('page_css')
	<link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet"/>
	<!-- City -->
	<link href="https://unpkg.com/@videojs/themes@1/dist/city/index.css" rel="stylesheet">
	
	<!-- Fantasy -->
	<link href="https://unpkg.com/@videojs/themes@1/dist/fantasy/index.css" rel="stylesheet">
	
	<!-- Forest -->
	<link href="https://unpkg.com/@videojs/themes@1/dist/forest/index.css" rel="stylesheet">
	
	<!-- Sea -->
	<link href="https://unpkg.com/@videojs/themes@1/dist/sea/index.css" rel="stylesheet">

	<link href="https://unpkg.com/@silvermine/videojs-quality-selector/dist/css/quality-selector.css" rel="stylesheet">

	<style>
		.video-js{
			outline: 1px solid #83be3f !important;
		}

		.video-js .vjs-big-play-button{
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
		}

		.vjs-modal-dialog .vjs-modal-dialog-content, .video-js .vjs-modal-dialog, .vjs-button > .vjs-icon-placeholder:before, .video-js .vjs-big-play-button .vjs-icon-placeholder:before{
			position: absolute;
			top: 50%;
			left: 50%;
			transform: translate(-50%, -50%);
			width: auto;
			height: auto;
		}

		.vjs-menu-content{
			border-radius: 2px;
		}

		.vjs-menu-item:hover{
			background: #83be3f !important;
		}

		.video-js .vjs-progress-holder{
			height: 1rem !important;
		}

		.video-js .vjs-play-progress:before{
			display: none;
		}
	</style>

	<script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
	<script src="https://unpkg.com/@silvermine/videojs-quality-selector/dist/js/silvermine-videojs-quality-selector.min.js"></script>
@endsection

@section('content')
	<div class="row container-fluid" style="padding-top: calc(70px + 1rem);">
		<div class="col col-lg-8">
			<section id="section-player" class="mb-2">
				<video id="my-video" class="video-js vjs-default-skin" controls preload="auto" style="width: 100%; height: 360px;" poster="{{ getPoster($episode) }}"
				       data-setup='{"controlBar": {"children": ["playToggle", "progressControl", "RemainingTimeDisplay", "VolumePanel", "qualitySelector", "PictureInPictureToggle", "fullscreenToggle"]}}'>
					@foreach($episode->media()->videos('episode')->get() as $media)
						<source src="{{ asset('private/media/'.$media->id) }}" type="{{ $media->type }}" label="{{ $media->pivot->type }}" @if($loop->first) selected="true" @endif>
					@endforeach
				</video>
			</section>
			<section id="section-info">
				<ul class="d-flex align-items-center text-white p-0" style="list-style: none">
					@foreach($episode->show()->first()->genres as $genre)
						<li class="pr-1"><a href="">#{{ $genre->name }}</a></li>
					@endforeach
				</ul>
				<h4 class="text-uppercase mb-2">{{ $episode->title }}<h4>
				<div class="d-flex justify-content-between align-items-center">
					<div>
						<ul class="list-inline d-flex align-items-center movie-content m-0">
							<li class="text-white">4,534 views</li>
							<li class="text-white">{{ $episode->created_at->format('M d, Y') }}</li>
						</ul>
						<div class="text-white"><i class="fa fa-clock-o mr-1"></i> {{ getDuration($episode) }}</div>
					</div>
					<div>
						<button class="btn btn-sm btn-success p-1 px-2"><i class="fa fa-thumbs-up"></i> 335</button>
						<button class="btn btn-sm btn-secondary p-1 px-2"><i class="fa fa-thumbs-down"></i> 99</button>
					</div>
				</div>
				<hr>
				<div class="d-flex align-items-center series mb-4">
					<img src="{{asset('frontend/images/trending/trending-label.png')}}" class="img-fluid">
					<span class="text-gold ml-3">#2 in Series Today</span>
				</div>
				<div class="description w-100 mb-0" style="font-size: 16px;">
					{!! $episode->description !!}
				</div>
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
		</div>
		<div class="col col-lg-4">
			<ul class="list-group p-0">
				<li class="d-flex p-0 mb-2">
					<a href="#!">
						<img src="{{ getPoster($episode) }}" style="width: 150px;height: 90px;"/>
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
	<script>
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
	</script>
@endsection