<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee\Employee;
use App\Models\Order\Order;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    public function getOrdersByWeek()
    {
        $start = carbon(request('start'))->startOfWeek();
        $end = carbon(request('start'))->endOfWeek();

        $week = \Date::between($start, $end);

        $orders = $this->getOrdersByDates($start, $end);

        $timeoffs = $this->getTimeOffs($start, $end);

        return response()->json([
            'orders'   => $orders,
            'timeoffs' => $timeoffs,
            'week'     => $week
        ]);
    }

    public function getOrdersByMonth()
    {
        $start = carbon(request('start'))->startOfMonth()->startOfWeek();;
        $end = carbon(request('start'))->endOfMonth()->endOfWeek();

        $weeks = collect(\Date::between($start, $end))->chunk(7)->mapWithKeys(function ($item) {
            return [$item->keys()->first() => $item];
        });

        $orders = $this->getOrdersByDates($start, $end);

        $timeoffs = $this->getTimeOffs($start, $end);

        return response()->json([
            'orders'   => $orders,
            'timeoffs' => $timeoffs,
            'weeks'    => $weeks
        ]);
    }

    /**
     * @param $start
     * @param $end
     * @return mixed
     */
    protected function getOrdersByDates($start, $end)
    {
        $orders = Order::where(function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end])
                    ->orWhereBetween('end_date', [$start, $end])
                    ->orWhere(function ($query) use ($start, $end) {
                        $query->where('start_date', '<', $start)
                            ->where('end_date', '>', $end);
                    });
            })
            ->when(request()->filled('employee'), function ($query) {
                $query->whereHas('employees', function ($query) {
                    $query->where('employee_id', request('employee'));
                });
            })
            ->when(request()->filled('client'), function ($query) {
                $query->where('client_id', request('client'));
            })
            ->when(request()->filled('location'), function ($query) {
                $query->where('client_location', request('location'));
            })
            ->when(request()->filled('status'), function ($query) {
                if (request('status') == 'canceled') {
                    $query->where('status', 'canceled');
                }

                if (in_array(request('status'), ['time_recorded', 'not_time_recorded'])) {
                    $query->where('status', '!=', 'canceled')
                        ->where('time_recorded', (request('status') == 'time_recorded'));
                }
            })
            ->with(['client' => function ($query) {
                $query->select('id', 'name', 'short_name');
            }])
            ->with(['contacts' => function ($query) {
                $query->select('id', 'first_name', 'last_name');
            }])
            ->with(['employees' => function ($query) {
                $query->select('id', 'first_name', 'last_name');
            }])
            ->get()
            ->sortBy('start_time');

        $results = [];

        for ($date = carbon($start); $date <= carbon($end); $date->addDay()) {
            $results[$date->format('Y-m-d')] = $orders->filter(function ($order) use ($date) {
                return $order->start_date == $date->format('Y-m-d') ||
                $order->end_date == $date->format('Y-m-d') ||
                ($order->start_date < $date->format('Y-m-d') && $order->end_date > $date->format('Y-m-d'));
            });
        }

        return $results;
    }

    protected function getTimeOffs($start, $end)
    {
        if (! request()->filled('employee'))
            return [];

        return Employee::find(request('employee'))
            ->timeoff()
            ->whereBetween('date', [$start, $end])
            ->get()
            ->groupBy('date');

    }
}
