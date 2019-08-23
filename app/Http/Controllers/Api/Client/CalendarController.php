<?php

namespace App\Http\Controllers\Api\Client;

use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    /**
     * Get orders and holidays for a client.
     *
     * @param $client
     *
     * @return mixed
     */
    public function getData($client)
    {
        $start = carbon(request('start'))->startOfMonth()->startOfWeek();;
        $end   = carbon(request('start'))->endOfMonth()->endOfWeek();

        $weeks = collect(\Date::between($start, $end))->chunk(7)->mapWithKeys(function($item) {
            return [$item->keys()->first() => $item];
        });

        $orders = $this->getOrdersByDates($client, $start, $end);

        return response()->json([
            'orders'   => $orders,
            'weeks'    => $weeks,
            'start'    => $start,
        ]);
    }

    /**
     * @param $client
     * @param $start
     * @param $end
     *
     * @return mixed
     */
    protected function getOrdersByDates($client, $start, $end)
    {
        return $client->orders()->whereBetween('start_date', [$start, $end])
            ->when(request()->has('employee'), function ($query) {
                $query->whereHas('employees', function ($query) {
                    $query->where('employee_id', request('employee'));
                });
            })
            ->with(['client', 'contacts', 'employees'])
            ->get()
            ->sortBy('start_time')
            ->groupBy('start_date');
    }
}
