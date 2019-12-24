<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
//use Illuminate\Support\Facades\Gate as GateContract;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        //
        $gate->define('isAdmin',function($user){
            return $user->role == 'admin';
        });
        
        $gate->define('isInspector',function($user){
            return $user->role == 'inspector';
        });
        
        $gate->define('isCoordinator',function($user){
            return $user->role == 'coordinator';
        });
        
        $gate->define('isStudent',function($user){
            return $user->role == 'student';
        });
    }
}
