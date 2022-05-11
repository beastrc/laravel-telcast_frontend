@extends('layouts.network.app')

@section('page_css')
	<style>
		.iq-sidebar,
		.iq-top-navbar,
		.iq-footer{
			display: none;
		}

		#content-page{
			padding: 0;
		}
	</style>
@endsection

@section('content')
	<div class="container py-4">
		<form action="{{ route('network.admin.store') }}" method="POST" enctype="multipart/form-data" class="mx-5 px-5">
			@csrf

			<fieldset class="mb-3 text-center">
				<img src="{{ asset('images/construction.png') }}" width="200">
			</fieldset>

			<div class="d-flex align-items-center justify-content-center mb-3">
				<img src="{{ asset('frontend/images/welcome.png') }}" width="32" class="mr-1">
				<h5>Hi!, {{ auth()->user()->name }}</h5>
			</div>

			<h2 class="text-center mb-3">Start by Creating Your Network</h2>

			<fieldset class="mb-3">
				<label class="form-label">{{ __('Category') }}</label>
				<select class="select-select2 category" name="category_id" required></select>
			</fieldset>

			<fieldset class="mb-3">
				<label class="form-label">{{ __('Title') }}</label>
				<input type="text" class="form-control" name="title" placeholder="Type in the network title/name" required>
			</fieldset>

			<fieldset class="mb-3">
				<label class="form-label">{{ __('Logo') }}</label>
				<div class="custom-file">
					<input type="file" class="custom-file-input" name="logo" id="logo" required>
					<label class="custom-file-label" for="logo">Choose Logo</label>
				</div>
			</fieldset>

			<fieldset class="mb-3">
				<label class="form-label">{{ __('Description') }}</label>
				<textarea class="form-control" rows="5" name="description" placeholder="Type in a few lines of description" required></textarea>
			</fieldset>

			<fieldset class="mb-3">
				<label class="form-label">{{ __('Phone') }}</label>
				<input type="text" class="form-control" name="phone" placeholder="Type in the network phone" required>
			</fieldset>

			<fieldset class="mb-5">
				<label class="form-label">{{ __('Email') }}</label>
				<input type="text" class="form-control" name="email" placeholder="Type in the network email" required>
			</fieldset>

			<fieldset class="mb-3 text-center">
				<button type="submit" class="btn btn-success btn-lg btn-block">Get Started</button>
			</fieldset>
		</form>
	</div>
@endsection

@section('page_js')
	<script>
		$('.select-select2.category').select2({
			width: '100%',
			placeholder: 'Please select category',
			ajax: {
				url: '{{ route('pagination.categories') }}',
				delay: 250,
				dataType: 'json',
				processResults: function (response) {
					return {
						results: response.data,
						pagination: {
							more: response.current_page < response.total
						}
					};
				}
			}
		});
	</script>
@endsection