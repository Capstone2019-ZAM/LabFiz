<?php

namespace App\Providers;

use App\Contracts\RestServiceContract;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(LoginController::class)
            ->needs(RestServiceContract::class)
            ->give(UserService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
