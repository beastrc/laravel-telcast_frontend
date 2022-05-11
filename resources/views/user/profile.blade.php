@extends('layouts.user.app')

@section('page_css')
@endsection

@section('content')
    <div class="row mb-4">
        <div class="col-12">
            <div class="bg-dark d-flex justify-content-center" style="height: 180px;">
                <span class="my-auto">Ad banner</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border">Profile</div>
                <div class="card-body border border-top-0">
                    <form method="POST" action="{{ route('user-profile-information.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3 row mx-0">
                            <label class="form-label">{{ __('Avatar') }}</label>
                            <div class="col-2 text-center">
                                <div class="border rounded p-2">
                                    <img src="{{ getUserAvatar() }}" width="64" class="img-fluid">
                                </div>
                            </div>
                            <div class="col">
                                <style>
                                    .file-input-preview img{
                                        width: 100px;
                                        border: 1px solid #dee2e6 !important;
                                        border-radius: 5px;
                                    }
                                </style>
                                <label class="form-label">{{ __('Change Avatar') }}</label>
                                <div class="file-drop-area">
                                    <span class="choose-file-button fw-bold">Choose File</span>
                                    <span class="file-message"></span>
                                    <input type="file" class="file-input" name="avatar" accept=".jpg,.jpeg,.png">
                                </div>
                                <div class="small text-grey-600"><strong>TIP:</strong> Best size for avatar is <code>45px(width) * 45px(height)</code></div>
                                <div class="file-input-preview" style="width: 120px;"></div>
                            </div>
                        </div>

                        <fieldset class="mb-3">
                            <label class="form-label">{{ __('First Name') }}</label>
                            <input type="text" name="firstname" class="form-control" value="{{ old('firstname') ?? auth()->user()->firstname }}" required autofocus>
                        </fieldset>

                        <fieldset class="mb-3">
                            <label class="form-label">{{ __('Last Name') }}</label>
                            <input type="text" name="lastname" class="form-control" value="{{ old('lastname') ?? auth()->user()->lastname }}" required>
                        </fieldset>

                        <div class="row">
                            <fieldset class="col form-group">
                                <label>{{ __('Country') }} (Current: <strong>{{ auth()->user()->country }}</strong>)</label>
                                <select class="countries form-control mb-0" name="country" id="countryId">
                                    <option value="">Select Country</option>
                                </select>
                            </fieldset>

                            <fieldset class="col form-group">
                                <label>{{ __('State') }} (Current: <strong>{{ auth()->user()->state }}</strong>)</label>
                                <select class="states form-control mb-0" name="state" id="stateId">
                                    <option value="">Select State</option>
                                </select>
                            </fieldset>

                            <fieldset class="col form-group">
                                <label>{{ __('City') }} (Current: <strong>{{ auth()->user()->city }}</strong>)</label>
                                <select class="cities form-control mb-0" name="city" id="cityId">
                                    <option value="">Select City</option>
                                </select>
                            </fieldset>
                        </div>

                        <fieldset class="mb-3">
                            <label class="form-label">{{ __('Email') }}</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') ?? auth()->user()->email }}" required autofocus />
                        </fieldset>

                        <fieldset class="mb-3">
                            <label>{{ __('Gender') }}</label>
                            <select class="form-control mb-0" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male" @if(auth()->user()->gender === 'male') selected @endif>Male</option>
                                <option value="female" @if(auth()->user()->gender === 'female') selected @endif>Female</option>
                                <option value="others" @if(auth()->user()->gender === 'others') selected @endif>Others</option>
                            </select>
                        </fieldset>

                        <fieldset class="mt-4">
                            <label>{{ __('Date of Birth') }}</label>
                            <input type="date" class="form-control mb-0" name="date_of_birth" value="{{ auth()->user()->date_of_birth }}" required>
                        </fieldset>

                        <fieldset class="mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Update Profile') }}</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
    <script src="//geodata.solutions/includes/countrystatecity.js"></script>
@endsection