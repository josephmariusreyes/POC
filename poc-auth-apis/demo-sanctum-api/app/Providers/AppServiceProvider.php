<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService\IUserService;
use App\Services\UserService\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //Todo-Jeph > Have a separate provider for this
        //We want to keepp the AppServiceProvider for global services
        $this->app->bind(IUserService::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
