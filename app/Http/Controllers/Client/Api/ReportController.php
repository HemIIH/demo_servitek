<?php

namespace App\Http\Controllers\Client\Api;

use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->client = auth()->user()->client;

            return $next($request);
        });
    }

    public function getOrderData()
    {
        if (! in_array(request('groupBy'), ['week', 'month']))
            return;

        if (request('groupBy') == 'week') {
            for ($i = now()->startOfWeek()->subMonths(2); $i <= now()->endOfWeek(); $i->addWeek()) {
                $labels[] = $i->weekOfYear;
            }

            $orders = \DB::table('orders')
                ->where('client_id', $this->client->id)
                ->whereBetween('start_date', [now()->startOfWeek()->subMonths(2), now()->endOfWeek()])
                ->groupBy('weekNum')
                ->get([\DB::raw('WEEk(start_date, 3) as weekNum, SUM(total_min) as total_time, COUNT(id) as orders')])
                ->groupBy('weekNum');
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $labels[] = $i;
            }

            $orders = \DB::table('orders')
                ->where('client_id', $this->client->id)
                ->whereYear('start_date', now()->format('Y'))
                ->groupBy('month')
                ->get([\DB::raw('MONTH(start_date) as month, SUM(total_min) as total_time, COUNT(id) as orders')])
                ->groupBy('month');
        }

        foreach($labels as $label) {
            $results['labels'][] = request('groupBy') == 'week' ? trans('admin.KW') . $label : \Date::monthName($label, false);
            $results['orders'][] = isset($orders[$label]) ? $orders[$label]->first()->orders : 0;
            $results['total_time'][] = isset($orders[$label]) ? (int) $orders[$label]->first()->total_time/60 : 0;
        };

        return $results;
    }

}