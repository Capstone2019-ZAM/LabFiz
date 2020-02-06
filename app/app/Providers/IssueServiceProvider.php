<?php

namespace App\Providers;

use App\Contracts\RestServiceContract;
use App\Http\Controllers\Api\v1\IssueController;
use App\Services\IssueService;
use Illuminate\Support\ServiceProvider;

class IssueServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when(IssueController::class)
            ->needs(RestServiceContract::class)
            ->give(IssueService::class);
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
