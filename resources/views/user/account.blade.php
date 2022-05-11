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

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header border">Account</div>
                <div class="card-body border border-top-0">
                    <form method="POST" action="{{ route('user-password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label">{{ __('Current Password') }}</label>
                            <input type="password" name="current_password" class="form-control" required autofocus
                                   autocomplete="current-password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Password') }}</label>
                            <input type="password" name="password" class="form-control" required
                                   autocomplete="new-password">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">{{ __('Confirm Password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control" required
                                   autocomplete="new-password">
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header border">Two Factor Authentication</div>
                <div class="card-body border border-top-0">
                    @if(! auth()->user()->two_factor_secret)
                        {{-- Enable 2FA --}}
                        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                            @csrf

                            <button type="submit" class="btn btn-primary">{{ __('Enable Two-Factor Authentication') }}</button>
                        </form>
                    @else
                        {{-- Disable 2FA --}}
                        <form method="POST" action="{{ url('user/two-factor-authentication') }}" class="my-3">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-primary">{{ __('Disable Two-Factor') }}</button>
                        </form>

                        {{-- Show SVG QR Code, After Enabling 2FA --}}
                        <div class="mb-3">
                            <h5>QR Code</h5>
                            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application.') }}
                        </div>

                        <div class="mb-3 text-center">
                            {!! auth()->user()->twoFactorQrCodeSvg() !!}
                        </div>

                        {{-- Show 2FA Recovery Codes --}}
                        <div class="mb-3">
                            <h5>Recovery Codes</h5>
                            {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                        </div>

                        <div class="mb-3">
                            <code>
                                @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                                    <div>{{ $code }}</div>
                                @endforeach
                            </code>
                        </div>

                        {{-- Regenerate 2FA Recovery Codes --}}
                        <form method="POST" action="{{ url('user/two-factor-recovery-codes') }}">
                            @csrf

                            <button type="submit"
                                    class="btn btn-warning">{{ __('Regenerate Recovery Codes') }}</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page_js')
@endsection