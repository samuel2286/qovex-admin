<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Support\Facades\RateLimiter;
use Laravel\Fortify\Contracts\LoginResponse;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Laravel\Fortify\Contracts\LogoutResponse;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance(LoginResponse::class,new class implements LoginResponse {
            public function toResponse($request){
                return redirect()->route('dashboard');
            }
        });
        $this->app->instance(LogoutResponse::class,new class implements LogoutResponse {
            public function toResponse($request){
                return redirect()->route('login');
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::loginView(function(){
            $title =  'login';
            return view('admin.auth.login',compact('title'));
        });
        Fortify::registerView(function(){
            $title = 'register';
            return view('admin.auth.register',compact('title'));
        });
        Fortify::requestPasswordResetLinkView(function(){
            $title = 'forgot password';
            return view('admin.auth.password.request',compact('title'));
        });
        Fortify::resetPasswordView(function($request){
            $title = 'reset password';
            return view('admin.auth.password.reset',compact('title'));
        });
        Fortify::confirmPasswordView(function () {
            return view('admin.auth.password.confirm');
        });
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
