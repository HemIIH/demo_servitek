<?php

namespace App\Listeners;

use App\Events\StaffUpdatedForOrder;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CalculatePlannedStaff
{
    /**
     * Handle the event.
     *
     * @param  StaffUpdatedForOrder  $event
     * @return void
     */
    public function handle(StaffUpdatedForOrder $event)
    {
        $planned = $event->order->employees()->approved()->count();

        $event->order->update([
            'staff_planned' => $planned
        ]);
    }
}
