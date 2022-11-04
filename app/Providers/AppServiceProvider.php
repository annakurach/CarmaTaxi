<?php

namespace App\Providers;

use App\Services\ApiToken\ApiTokenServiceService;
use App\Services\ApiToken\TokenServiceInterface;
use App\Services\Post\PostService;
use App\Services\Post\PostServiceInterface;
use App\Services\User\UserService;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            UserServiceInterface::class,
            UserService::class
        );
        $this->app->singleton(
            TokenServiceInterface::class,
            ApiTokenServiceService::class
        );
        $this->app->singleton(
            PostServiceInterface::class,
            PostService::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
