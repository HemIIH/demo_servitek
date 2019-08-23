<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\TimetrackingUpdated::class => [
            \App\Listeners\CalculateWorkingTimeAccounts::class,
            \App\Listeners\UpdateOrder::class
        ],
        \App\Events\ExtraBusinessUpdated::class => [
            \App\Listeners\CalculateWorkingTimeAccounts::class,
        ],
        \App\Events\StaffUpdatedForOrder::class => [
            \App\Listeners\CalculatePlannedStaff::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
