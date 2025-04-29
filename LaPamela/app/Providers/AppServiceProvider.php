<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\RegisterViewResponse;
use App\Fortify\Responses\LoginViewResponse as CustomLoginViewResponse;
use App\Fortify\Responses\RegisterViewResponse as CustomRegisterViewResponse;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Actions\Fortify\CreateNewUser;
use Laravel\Fortify\Contracts\RegisterResponse;
use App\Fortify\Responses\RegisterResponse as CustomRegisterResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
{
    $this->app->singleton(CreatesNewUsers::class, CreateNewUser::class);
    $this->app->singleton(LoginViewResponse::class, CustomLoginViewResponse::class);
    $this->app->singleton(RegisterViewResponse::class, CustomRegisterViewResponse::class);
    $this->app->singleton(RegisterResponse::class, CustomRegisterResponse::class);
}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
