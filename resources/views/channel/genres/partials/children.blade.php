<li class="dd-item dd3-item" id="genre_{{ $genre->id }}" data-id="{{ $genre->id }}">
	<div class="d-flex w-100">
		<div class="dd-handle dd3-handle rounded-left"><i class="fas fa-bars mx-auto"></i></div>
		<div class="dd3-content rounded-right w-100 p-2 d-inline">
			<div class="d-flex align-items-center justify-content-between">
				<div class="left" data-toggle="collapse" href="#{{ $genre->slug . '-' . $genre->id }}">
					<img src="{{ asset('storage/' . $genre->thumbnail) }}"
					     class="img-thumbnail img-fluid mr-1">
					<strong>{{ $genre->name }}</strong>
				</div>
				<span class="right">
                    <i class="btn-edit fas fa-pencil-alt mr-1"
                       data-url-edit="{{ route('admin.genres.edit', $genre->id) }}"
                       data-url-update="{{ route('admin.genres.update', $genre->id) }}"></i>
                    <i class="btn-delete fas fa-times fa-lg text-danger mr-1"
                       data-url="{{ route('admin.genres.destroy', $genre->id) }}"></i>
                </span>
			</div>
			<div class="collapse fade" id="{{ $genre->slug . '-' . $genre->id }}">
				<div class="card card-body py-0">
					{{ $genre->description }}
				</div>
			</div>
		</div>
	</div>
	<ol class="dd-list">
		@foreach($genre->children as $child)
			@if(isset($child->children) && $child->children()->exists())
				@include('admin.genres.partials.children', ['genre' => $child])
			@else
				<li class="dd-item dd3-item" id="genre_{{ $child->id }}" data-id="{{ $child->id }}">
					<div class="d-flex w-100">
						<div class="dd-handle dd3-handle rounded-left"><i class="fas fa-bars mx-auto"></i></div>
						<div class="dd3-content rounded-right w-100 p-2 d-inline">
							<div class="d-flex align-items-center justify-content-between">
								<div class="left" data-toggle="collapse"
								     href="#{{ $child->slug . '-' . $child->id }}">
									<img src="{{ asset('storage/' . $child->thumbnail) }}"
									     class="img-thumbnail img-fluid mr-1">
									<strong>{{ $child->name }}</strong>
								</div>
								<span class="right">
                                <i class="btn-edit fas fa-pencil-alt mr-1"
                                   data-url-edit="{{ route('admin.genres.edit', $child->id) }}"
                                   data-url-update="{{ route('admin.genres.update', $child->id) }}"></i>
								<i class="btn-delete fas fa-times fa-lg text-danger mr-1"
								   data-url="{{ route('admin.genres.destroy', $genre->id) }}"></i>
                            </span>
							</div>
							<div class="collapse fade" id="{{ $child->slug . '-' . $child->id }}">
								<div class="card card-body py-0">
									{{ $child->description }}
								</div>
							</div>
						</div>
					</div>
				</li>
			@endif
		@endforeach
	</ol>
</li>
