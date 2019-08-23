<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        \App\Models\Employee\Employee::class => \App\Policies\EmployeePolicy::class,
        \App\Models\User\User::class         => \App\Policies\UserPolicy::class,
        \App\Models\Client\Client::class     => \App\Policies\ClientPolicy::class,
        \App\Models\Order\Order::class       => \App\Policies\OrderPolicy::class,
        \App\Models\Note::class              => \App\Policies\NotePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        \Gate::define('financials', function ($user) {
            return $user->hasRole('master_admin');
        });

        \Gate::define('reports', function ($user) {
            return $user->hasRole('master_admin') || $user->hasRole('accountant');
        });

        \Gate::define('documents', function ($user) {
            return $user->hasRole('master_admin') || $user->hasRole('local_manager');
        });

        \Gate::define('settings', function ($user) {
            return $user->hasRole('master_admin');
        });

        \Gate::define('orders', function ($user) {
            return ! $user->hasRole('accountant');
        });

        \Gate::define('clients', function ($user) {
            return ! $user->hasRole('accountant');
        });

        \Gate::define('timetracking', function ($user) {
            return $user->hasRole('master_admin') || $user->hasRole('local_manager');
        });

        \Gate::define('user', function ($user) {
            return $user->hasRole('master_admin');
        });
    }
}
