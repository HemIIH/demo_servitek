<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Order\Order;

class TimeTrackingController extends Controller
{

    /**
     * Get data for list view.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Order::with('client')
            ->active()
            ->where('time_recorded', 0)
            ->where('staff_planned', '>', 0)
            ->where('end_date', '<', now())
            ->search()
            ->paginateAndOrder();
    }

}
