<?php

namespace App\Providers;

use App\Models\Organization;
use App\Models\User;
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

        Gate::define('account-manager', function(User $user){
            return $user->isAdmin();
        });

        Gate::define('people-manage', function(User $user, Organization $organization){
            return $user->isAdmin() || $organization->user_id == $user->id;
        });
    }
}
