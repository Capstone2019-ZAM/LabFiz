<?php

namespace App\Providers;

use App\Contracts\RestServiceContract;
use App\Http\Controllers\Api\v1\InspectionController;
use App\Services\InspectionService;
use Illuminate\Support\ServiceProvider;

class InspectionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(InspectionController::class)
            ->needs(RestServiceContract::class)
            ->give(InspectionService::class);
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
