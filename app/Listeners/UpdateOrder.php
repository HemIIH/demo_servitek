<?php

namespace App\Listeners;

use App\Events\TimetrackingUpdated;
use App\Models\Order\Repos\TimetrackingRepository;

class UpdateOrder
{
    protected $timetracking;

    /**
     * Create the event listener.
     *
     * @param TimetrackingRepository $timetracking
     */
    public function __construct(TimetrackingRepository $timetracking)
    {
        $this->timetracking = $timetracking;
    }

    /**
     * Handle the event.
     *
     * @param  TimetrackingUpdated  $event
     * @return void
     */
    public function handle(TimetrackingUpdated $event)
    {        
        $order = $event->order;

        if (! $order->timetrackings()->exists()) {

            $event->order->update([
                'total_min'     => 0,
                'total_wage'    => 0,
                'total_income'  => 0,
                'total_cost'    => 0,
                'time_recorded' => false
            ]);

            return;
        }

        $wageTotal = 0;
        $costTotal  = 0;

        foreach ($timetrackings = $order->timetrackings as $item) {
            $wage = $item->employee->wages()->validAt($item->date)->first();

            if(! $wage)
                continue;

            $wageTotal += calculateCost($item->total_min, $wage->amount);
            $costTotal += calculateCost($item->total_min, $wage->amount) * config('settings.staff_cost_factor')[$item->employee->occupation_type];
        };

        $rate = $order->client->rates()->validAt($order->start_date)->first();

        $order->update([
            'total_min'     => $timetrackings->sum('total_min'),
            'total_wage'    => $wageTotal,
            'total_income'  => calculateCost($timetrackings->sum('total_min'), $rate ? $rate->amount : 0),
            'total_cost'    => $costTotal,
            'time_recorded' => $timetrackings->pluck('end_time')->contains(null) ? false : true
        ]);
    }
}
