<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class EloquentModelObserverProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}
