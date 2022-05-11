@extends('layouts.frontend.app')

@section('page_css')
@endsection

@section('content')
	<section id="home" class="iq-main-slider p-0 iq-rtl-direction">
		<div class="container-fluid position-relative h-100 pb-5" style="padding-top: calc(70px + 2rem) !important;">
			<div class="row align-items-center h-100 iq-ltr-direction">
				<div class="col-12">
					<h1 class="slider-text big-title title text-uppercase" data-animation-in="fadeInLeft"
					    data-delay-in="0.6">{{ $show->title }}</h1>
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
							<span class="text-white ml-2">{{ $show->imdb_rating }} (IMDB)</span>
						</div>
						<div class="d-flex align-items-center mt-2 mt-md-3">
							<span class="badge badge-secondary p-2">{{ $show->content_rating }}</span>
							<span class="ml-3">{{ $show->seasons()->count() }} Seasons</span>
						</div>
					</div>
					<p data-animation-in="fadeInUp" data-delay-in="1.2">
						{{ $show->description }}
					</p>
					<div class="trending-list" data-wp_object-in="fadeInUp" data-delay-in="1.2">
						<div class="text-primary title starring">
							Starring:
							<span class="text-body">{{ implode(', ', $show->actors) }}</span>
						</div>
						<div class="text-primary title genres">
							Genres:
							<span class="text-body">{{ $show->genres->pluck('name')->implode(', ') }}</span>
						</div>
						<div class="text-primary title tag">
							Tags:
							{{--							<span class="text-body">@{{ implode(', ', $show->tags) }}</span>--}}
						</div>
					</div>
					<div class="d-flex align-items-center r-mb-23 mt-3" data-animation-in="fadeInUp"
					     data-delay-in="1.2">
						<a href="" class="btn btn-hover iq-button">
							<i class="fa fa-play mr-2"></i>
							Play Now
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section id="section-seasons" class="mb-4">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12 overflow-hidden">
					<div class="iq-main-header d-flex align-items-center justify-content-between">
						<h4 class="main-title">Seasons</h4>
						<div class="d-flex slick-aerrow-block"></div>
					</div>
					<div class="favorites-contens">
						@if(isset($show->seasons) && $show->seasons->isNotEmpty())
							<ul id="slick-seasons"
							    class="favorites-slider list-inline row p-0 mb-0 iq-rtl-direction">
								@foreach($show->seasons as $season)
									<li class="slide-item">
										<div class="block-images position-relative">
											<div class="img-box">
												<img data-lazy="{{ getPoster($season) }}" class="img-fluid"/>
											</div>
											<div class="block-description">
												<h6 class="iq-title">
													<a href="{{ route('frontend.shows.seasons.show', [$show->id, $season->id]) }}">{{ $season->title }}</a>
												</h6>
												<div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
													<div class="badge badge-secondary p-1 mr-2">{{ $season->content_rating }}</div>
													<span class="text-white">{{ $season->episodes()->count() }} episodes</span>
												</div>
												<div class="hover-buttons">
													<a href="{{ route('frontend.shows.seasons.show', [$show->id, $season->id]) }}" class="btn btn-hover iq-button">
														<i class="fa fa-play mr-1"></i>
														Watch Now
													</a>
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
														<span class="count-box">{{ $season->content_rating }}+</span>
													</li>
													<li><span><i class="ri-add-line"></i></span></li>
												</ul>
											</div>
										</div>
									</li>
								@endforeach
							</ul>
						@else
							<div class="text-center">No resource found</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection

@section('page_js')
	<script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
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

        $('#slick-seasons').slick({
            ...options,
            appendArrows: $('#slick-seasons').parent().prev().find('.slick-aerrow-block'),
        });
	</script>
@endsection