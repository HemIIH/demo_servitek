<?php

namespace App\Providers;

use App\Models\Notifications;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['emails.*', 'pdf.*'], function ($view) {
            $textblocks = \DB::table('textblocks')->selectRaw('CONCAT(type,"." ,name) as name, value')->pluck('value', 'name');

            $view->with(compact('textblocks'));
        });

        View::composer('layouts.admin', function ($view) {
           $notifications = Notifications::byType('Order');

            $view->with(compact('notifications'));
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
