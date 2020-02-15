<?php

namespace App\Providers;

use App\Contracts\RestServiceContract;
use App\Http\Controllers\Api\v1\ReportController;
use App\Services\ReportService;
use Illuminate\Support\ServiceProvider;

class ReportServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(ReportController::class)
            ->needs(RestServiceContract::class)
            ->give(ReportService::class);
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
