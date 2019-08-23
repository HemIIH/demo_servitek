<?php

namespace App\Http\Controllers\Api\Employee;

use App\Models\Employee\Employee;
use App\Http\Controllers\Controller;

class CalendarController extends Controller
{
    /**
     * Get orders and holidays for an employee.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData(Employee $employee)
    {
        $start = carbon(request('start'))->startOfMonth()->startOfWeek();;
        $end   = carbon(request('start'))->endOfMonth()->endOfWeek();

        $weeks = collect(\Date::between($start, $end))->chunk(7)->mapWithKeys(function($item) {
            return [$item->keys()->first() => $item];
        });

        $orders = $this->getOrdersByDates($employee, $start, $end);

        $timeoffs = $this->getTimeOffs($employee);

        return response()->json([
            'orders'   => $orders,
            'timeoffs' => $timeoffs,
            'weeks'    => $weeks,
            'start'    => $start,
        ]);
    }

    public function getTimeOffs(Employee $employee)
    {
        return $employee->timeoff->groupBy('date');
    }

    /**
     * @param Employee $employee
     * @param $start
     * @param $end
     * @return mixed
     */
    protected function getOrdersByDates(Employee $employee, $start, $end)
    {
        return $employee->orders()->whereBetween('start_date', [$start, $end])
            ->with(['client', 'contacts'])
            ->get()
            ->sortBy('start_time')
            ->groupBy('start_date');
    }
}
