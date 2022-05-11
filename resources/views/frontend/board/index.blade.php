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
            <h4>Board</h4>
            <form action="{{ route('frontend.board.index') }}" method="GET">
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

        @if(isset($board) && $board->isNotEmpty())
            @if(request()->has('keywords') && request()->keywords)
                <div class="mb-4">
                    Found <strong>{{ $board->total() }}</strong> results in <strong>{{ $board->lastPage() }}</strong>
                    pages,
                    matching <strong>{{ request()->keywords }}</strong>
                </div>
            @endif

            <ul class="favorites-slider list-inline row p-0 mb-5 iq-rtl-direction">
                @foreach($board as $item)
                    <li class="slide-item">
                        <div class="block-images position-relative">
                            <div class="img-box">
                                <img src="{{ getPoster($item->myListable) }}" class="img-fluid">
                            </div>
                            <div class="block-description">
                                <h6 class="iq-title">
                                    <a href="{{ getRoute($item->myListable) }}">{{ $item->myListable->title }}</a>
                                </h6>
                                <div class="movie-time d-flex align-items-center my-2 iq-ltr-direction">
                                    <div class="badge badge-secondary p-1 mr-2">
                                        {{ $item->myListable->content_rating }} +
                                    </div>
                                    <span class="text-white">{{ getDuration($item->myListable) }}</span>
                                </div>
                                <div class="hover-buttons">
                                    <a href="{{ getRoute($item->myListable) }}" class="btn btn-hover iq-button">
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

            <div class="d-flex justify-content-end">
                {{ $board->links() }}
            </div>
        @elseif(request()->has('keywords') && request()->keywords)
            <div class="mb-4">
                Found <strong>{{ $board->total() }}</strong> results in <strong>{{ $board->lastPage() }}</strong>
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