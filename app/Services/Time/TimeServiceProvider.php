<?php
namespace  App\Services\Time;

use Illuminate\Support\ServiceProvider;

class TimeServiceProvider extends ServiceProvider {

    /**
     * Register in IoC container
     */
    public function register()
    {
        $this->app->bind('time', \App\Services\Time\TimeService::class);
    }
}