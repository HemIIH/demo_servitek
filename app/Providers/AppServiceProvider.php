<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        \Validator::extend('decimal', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^([1-9]\d*|\d*,\d{1,2}|0|0,00)$/', $value);
        });

        \Validator::extend('num_spaces', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^[\d\s]+$/', $value);
        });

        \Validator::extend('time', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(([01]?\d|2[0-3]):[0-5]\d|2[0-3]|1?\d)$/', $value);
        });

        \Validator::extend('phone', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(0)\d{1,14}$/', $value);
        });

        Relation::morphMap([
            'employees' => 'App\Models\Employee\Employee',
            'orders'    => 'App\Models\Order\Order',
            'clients'   => 'App\Models\Client\Client',
            'invoices'  => 'App\Models\Client\Invoices',
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
