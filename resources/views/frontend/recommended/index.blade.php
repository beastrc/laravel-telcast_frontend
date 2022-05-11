@extends('layouts.frontend.app')

@section('page_css')
    <style>
        .slide-item {
            padding-bottom: 20px;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid" style="padding-top: 80px;">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <h4>Movies</h4>
            <form action="{{ route('frontend.recommended.index') }}" method="GET">
                <div class="input-group">
                    <input class="form-control border-secondary" name="keywords" value="{{ request()->keywords }}"
                           placeholder="Search...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary px-3"><i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        @if(isset($genres) && $genres->isNotEmpty())
            @if(request()->has('keywords') && request()->keywords)
                <div class="mb-4">
                    Found <strong>{{ $genres->pluck('recommended')->first()->count() }}</strong> results,
                    matching <strong>{{ request()->keywords }}</strong>
                </div>
            @endif

            @foreach($genres as $genre)
                <div class="d-flex justify-content-between">
                    <h5 class="mb-3">{{ $genre->name }}</h5>
                    <a href="{{ route('frontend.recommended.genres', $genre->id) }}" class="ml-3 cursor-pointer">
                        View all <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>

                @if(isset($genre->recommended) && $genre->recommended->isNotEmpty())
                    <ul class="list-inline row p-0 mb-5 iq-rtl-direction mx-0">
                        @foreach($genre->recommended as $item)
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
                                            <div class="badge badge-secondary p-1 mr-2">{{ $item->content_rating }}+
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
            @endforeach

            <div class="d-flex justify-content-end">
                {{ $genres->links() }}
            </div>
        @elseif(request()->has('keywords') && request()->keywords)
            <div class="mb-4">
                Found <strong>{{ $genres->pluck('recommended')->first()->count() }}</strong> results,
                matching <strong>{{ request()->keywords }}</strong>
            </div>
        @else
            <div>No resource found</div>
        @endif
    </div>
@endsection

@section('page_js')
@endsection