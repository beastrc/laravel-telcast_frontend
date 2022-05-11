<div class="myadmin-dd-empty dd">
	<ol class="dd-list" id="categories">
		@if(isset($genres) && $genres->isNotEmpty())
			@foreach($genres as $genre)
				@if($genre->children()->exists())
					@include('admin.genres.partials.children', ['genre' => $genre])
				@else
					<li class="dd-item dd3-item" id="genre_{{ $genre->id }}"
					    data-id="{{ $genre->id }}">
						<div class="d-flex">
							<div class="dd-handle dd3-handle rounded-left">
								<i class="fas fa-bars mx-auto"></i>
							</div>
							<div class="dd3-content rounded-right w-100 p-2">
								<div class="d-flex align-items-center justify-content-between">
									<div class="left" data-toggle="collapse"
									     href="#{{ $genre->slug . '-' . $genre->id }}">
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
					</li>
				@endif
			@endforeach
		@else
			<div class="text-center no-category">No Genre found!</div>
		@endif
	</ol>
</div>