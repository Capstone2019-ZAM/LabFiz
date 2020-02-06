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
        $this->app->register(
            LabServiceProvider::class
        );

        $this->app->register(
            UserServiceProvider::class
        );

        $this->app->register(
            ReportServiceProvider::class
        );

        $this->app->register(
            InspectionServiceProvider::class
        );

        $this->app->register(
            IssueServiceProvider::class
        );
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
