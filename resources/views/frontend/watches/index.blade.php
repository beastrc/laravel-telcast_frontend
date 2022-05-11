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
            <h4>Continue Watching</h4>
            <form action="{{ route('frontend.watches.index') }}" method="GET">
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

        @if(isset($watches) && $watches->isNotEmpty())
            @if(request()->has('keywords') && request()->keywords)
                <div class="mb-4">
                    Found <strong>{{ $watches->total() }}</strong> results in
                    <strong>{{ $watches->lastPage() }}</strong>
                    pages,
                    matching <strong>{{ request()->keywords }}</strong>
                </div>
            @endif

            <ul class="favorites-slider list-inline row p-0 mb-5 iq-rtl-direction">
                @foreach($watches as $watch)
                    <li class="slide-item">
                        <div class="block-images position-relative">
                            <div class="img-box">
                                <img src="{{ getPoster($watch->watchable) }}" class="img-fluid">
                            </div>
                            <div class="block-description">
                                <h6 class="iq-title">
                                    <a href="{{ getRoute($watch->watchable) . '?t=' . $watch->current_time }}">{{ $watch->watchable->title }}</a>
                                </h6>
                                <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                    <div class="badge badge-secondary p-1 mr-2">{{ $watch->watchable->content_rating }}+
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

            <div class="d-flex justify-content-end">
                {{ $watches->links() }}
            </div>
        @elseif(request()->has('keywords') && request()->keywords)
            <div class="mb-4">
                Found <strong>{{ $watches->total() }}</strong> results in <strong>{{ $watches->lastPage() }}</strong>
                pages,
                matching <strong>{{ request()->keywords }}</strong>
            </div>
        @else
            <div>No resource found</div>
        @endif
    </div>
@endsection

@section('page_js')
@endsection