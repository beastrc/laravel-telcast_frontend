<?php

namespace App\Providers;

use App\Http\Responses\LoginResponse;
use App\Http\Responses\TwoFactorLoginResponse;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;

class FortifyUIServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
        $this->app->singleton(TwoFactorLoginResponseContract::class, TwoFactorLoginResponse::class);

        Fortify::loginView(function () {
            return view('auth.login');
        });

//        Fortify::registerView(function () {
//            return view('auth.register');
//        });

        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

         Fortify::verifyEmailView(function () {
             return view('auth.verify-email');
         });

         Fortify::confirmPasswordView(function () {
             return view('auth.confirm-password');
         });

         Fortify::twoFactorChallengeView(function () {
             return view('auth.two-factor-challenge');
         });
    }
}
