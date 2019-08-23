<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->client = auth()->user()->client;

            return $next($request);
        });
    }

    public function getOrdersByMonth()
    {
        $start = carbon(request('start'))->startOfMonth()->startOfWeek();;
        $end = carbon(request('start'))->endOfMonth()->endOfWeek();

        $weeks = collect(\Date::between($start, $end))->chunk(7)->mapWithKeys(function ($item) {
            return [$item->keys()->first() => $item];
        });

        $orders = $this->getOrdersByDates($start, $end);

        return response()->json([
            'orders' => $orders,
            'weeks'  => $weeks,
            'start'  => $start,
        ]);
    }

    public function getOrdersByWeek()
    {
        $start = carbon(request('start'))->startOfWeek();
        $end = carbon(request('start'))->endOfWeek();

        $week = \Date::between($start, $end);

        $orders = $this->getOrdersByDates($start, $end);

        return response()->json([
            'orders' => $orders,
            'week'   => $week
        ]);
    }

    /**
     * @param $start
     * @param $end
     *
     * @return mixed
     */
    protected function getOrdersByDates($start, $end)
    {
        return $this->client->orders()->whereBetween('start_date', [$start, $end])
            ->with(['client'])
            ->get()
            ->sortBy('start_time')
            ->groupBy('start_date');
    }

}