<?php

namespace App\Providers;

use App\Contracts\RestServiceContract;
use App\Http\Controllers\Api\v1\LabController;
use App\Http\Controllers\Controller;
use App\Services\LabService;
use App\Services\UserService;
use Illuminate\Support\Facades\App;
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

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
