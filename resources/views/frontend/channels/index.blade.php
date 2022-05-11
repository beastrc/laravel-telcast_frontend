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
            <h4>Channels</h4>
            <form action="{{ route('frontend.channels.index') }}" method="GET">
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

        @if(isset($categories) && $categories->isNotEmpty())
            @if(request()->has('keywords') && request()->keywords)
                <div class="mb-4">
                    Found <strong>{{ $categories->pluck('channels')->first()->count() }}</strong> results,
                    matching <strong>{{ request()->keywords }}</strong>
                </div>
            @endif

            @if($categories->isNotEmpty())
                @foreach($categories as $category)
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-3 text-capitalize">{{ $category->title }}</h5>
                    </div>
                    <ul class="list-inline row p-0 mb-0 iq-rtl-direction">
                        @foreach($category->channels as $channel)
                            <li class="slide-item">
                                <a href="{{ route('frontend.channels.show', $channel->id) }}"
                                   class="rounded-circle bg-white d-flex" style="height: 100px;width: 100px;">
                                    <img src="{{ asset("storage/{$channel->logo}") }}" class="my-auto mx-auto"
                                         width="48">
                                </a>
                                <div class="mt-2 text-center">{{ $channel->title }}</div>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            @endif

            <div class="d-flex justify-content-end">
                {{ $categories->links() }}
            </div>
        @elseif(request()->has('keywords') && request()->keywords)
            <div class="mb-4">
                Found <strong>{{ $categories->total() }}</strong> results in
                <strong>{{ $categories->lastPage() }}</strong>
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