<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client\Client;
use App\Models\Employee\Employee;

class CalendarController extends Controller
{

    /**
     * Show orders in calendar overview.
     *
     * @return \Illuminate\View\View
     */
    public function overview()
    {
        $data['clients'] = Client::orderBy('short_name')->get(['id', 'short_name']);
        $data['locations'] = \DB::table('locations')->get();

        return view('admin.calendar.overview', $data);
    }

    /**
     * Show orders for employeee.
     *
     * @return \Illuminate\View\View
     */
    public function employees()
    {
        if (request()->has(['start', 'end'])) {
            $start = carbon(request('start'));
            $end   = carbon(request('end'));
        } else {
            $start = now()->startOfWeek();
            $end   = carbon($start)->endOfWeek();
        };

        $employees = Employee::with(['orders', 'orders.client'])
            ->whereHas('orders', function ($query) use ($start, $end) {
                $query->whereBetween('start_date', [$start, $end]);
            })->orderBy('last_name')->get();

        $dates = \Date::between($start, $end);

        return view('admin.calendar.employees', compact('employees', 'dates', 'start', 'end'));
    }

    /**
     * Show orders by week or month.
     *
     * @param string $type
     * @return \Illuminate\View\View
     */
    public function ordersBy($type)
    {
        if ($type == 'week') {
            $data['start'] = carbon(request('start', now()))->startOfWeek()->format('Y-m-d');
        } else {
            $data['start'] = carbon(request('start', now()))->startOfMonth()->format('Y-m-d');
        }

        $data['employees'] = Employee::orderBy('last_name')->get(['id', 'first_name', 'last_name']);
        $data['clients']   = Client::orderBy('short_name')->get(['id', 'short_name']);
        $data['locations'] = auth()->user()->hasRole('master_admin') ? \DB::table('locations')->pluck('name') : collect(auth()->user()->locations);

        return view('admin.calendar.orders_by_' . $type , $data);
    }
}
