<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        /* define a admin user role */
        Gate::define('is-admin', function ($user) {
            return $user->role == 'admin';
        });

        Gate::define('is-employee', function ($user) {
            return $user->role == 'employee' || $user->role == 'team_lead';
        });

        Gate::define('is-manager', function ($user) {
            return $user->role == 'manager'; 
        });

        Gate::define('is-both', function ($user) {
            return $user->role == 'employee' || $user->role == 'admin' || $user->role == 'manager' || $user->role == 'team_lead';  
        });

        Gate::define('is-universal', function ($user) {
            return $user->role == 'admin' || $user->role == 'manager';
        });

        Gate::define('materialCheck', function ($user) {
            return in_array($user->role, ['admin', 'manager', 'ceo', 'finance-admin', 'finance-dept']);
        });
        Gate::define('is-team-lead',function($user){
            return $user->role == 'admin' || $user->role == 'manager' || $user->role == 'team_lead' ;     
        });
    }
}
