<?php

namespace App\Models\Order\Repos;

use App\Models\Order\Timetracking;

class TimetrackingRepository
{
    /**
     * Get timetrackings for one client grouped by employee.
     *
     * @param $client
     * @return mixed
     */
    public function groupedByEmployee($client)
    {
        $orderIds = $client->orders->pluck('id');

        return Timetracking::whereIn('order_id', $orderIds)
            ->groupBy('employee_id')
            ->with('employee')
            ->orderBy('total_min', 'desc')
            ->get(['employee_id', \DB::raw('SUM(total_min) as total_min, COUNT(timetrackings.id) as no_of_orders')]);
    }

    /**
     * Get timetrackings for one employee grouped by client.
     *
     * @param $employee
     * @return mixed
     */
    public function groupedByClient($employee)
    {
        return Timetracking::rightJoin('orders', 'order_id', '=' , 'orders.id')
            ->rightJoin('clients', 'client_id', '=' , 'clients.id')
            ->where('employee_id', $employee->id)
            ->groupBy('client_id')
            ->orderBy('total_min', 'desc')
            ->get(['client_id', 'name', \DB::raw('SUM(timetrackings.total_min) as total_min, COUNT(timetrackings.id) as no_of_orders')]);
    }

    /**
     * Get timetrackings for employee/client grouped by date.
     *
     * @param $model
     * @return mixed
     */
    public function groupedByDate($type, $model)
    {
        switch ($type) {
            case 'employee':
                $query = Timetracking::where('employee_id', $model->id);
                break;
            case 'client':
                $orderIds = $model->orders()->pluck('id');
                $query = Timetracking::whereIn('order_id', $orderIds);
                break;
            default:
                return [];
        }

        return $query->groupBy('month', 'year')
                ->orderBy('year', 'desc')
                ->orderBy('month', 'desc')
                ->get([\DB::raw('SUM(timetrackings.total_min) as total_min, MONTH(date) as month, YEAR(date) as year, COUNT(timetrackings.id) as no_of_orders')]);
    }

    /**
     * Get total time for an employee in one month.
     *
     * @param $employee
     * @param $date
     * @return mixed
     */
    public function totalByDate($employee, $date)
    {
        return $employee->timetrackings()
            ->whereMonth('date', $date->format('m'))
            ->whereYear('date', $date->format('Y'))
            ->sum('total_min');
    }

}