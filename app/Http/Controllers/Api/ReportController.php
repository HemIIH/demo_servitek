<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client\Invoice;
use App\Models\Employee\Employee;
use App\Models\Order\Order;

class ReportController extends Controller
{

    public function getOrderData()
    {
        if (! in_array(request('groupBy'), ['week', 'month']))
            return;

        if (request('groupBy') == 'week') {
            for ($i = now()->startOfWeek()->subMonths(2); $i <= now()->endOfWeek(); $i->addWeek()) {
                $labels[] = $i->weekOfYear;
            }

            $orders = Order::whereBetween('start_date', [now()->startOfWeek()->subMonths(2), now()->endOfWeek()])
                ->groupBy('weekNum')
                ->get([\DB::raw('WEEk(start_date, 3) as weekNum, SUM(total_min) as total_time, COUNT(id) as orders')])
                ->groupBy('weekNum');
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $labels[] = $i;
            }

            $orders = Order::whereYear('start_date', request('year', now()->format('Y')))
                ->groupBy('month')
                ->get([\DB::raw('MONTH(start_date) as month, SUM(total_min) as total_time, COUNT(id) as orders')])
                ->groupBy('month');
        }

        $results['datasets']['0']['label'] = 'Zahl der Aufträge';
        $results['datasets']['1']['label'] = 'Gesamtzeit (Std.)';

        foreach($labels as $label) {
            $results['labels'][] = request('groupBy') == 'week' ?  trans('admin.KW') . $label : trans('admin.'.\Date::monthName($label, false));
            $results['datasets']['0']['values'][] = isset($orders[$label]) ? $orders[$label]->first()->orders : 0;
            $results['datasets']['1']['values'][] = isset($orders[$label]) ? (int) $orders[$label]->first()->total_time/60 : 0;
        };

        return $results;
    }

    public function getEmployeePoolStatistic($type)
    {
        $employeeData  = Employee::selectRaw(
                'SUM(IF(sex = "f", 1, 0)) AS female,
                 SUM(IF(sex = "m", 1, 0)) AS male,
                 SUM(IF(occupation_type = "part_time", 1, 0)) AS part_time,
                 SUM(IF(occupation_type = "temporary", 1, 0)) AS temporary'
            )
            ->active()
            ->first();

        if ($type == 'gender') {
            return response()->json([
                trans('admin.Männlich')  => $employeeData->male,
                trans('admin.Weiblich')  => $employeeData->female
            ]);
        }

        if ($type == 'occupation') {
            return response()->json([
                trans('admin.Teilzeit')    => $employeeData->part_time,
                trans('admin.Geringfügig') => $employeeData->temporary
            ]);
        }
    }

    public function getInvoiceData()
    {
        if (! in_array(request('groupBy'), ['week', 'month']))
            return;

        if (request('groupBy') == 'week') {
            for ($i = now()->startOfWeek()->subMonths(2); $i <= now()->endOfWeek(); $i->addWeek()) {
                $labels[] = $i->weekOfYear;
            }

            $invoices = Invoice::select([\DB::raw('WEEk(invoice_date, 3) as weekNum, SUM(sum) as sum')])
                ->withCount('items')
                ->whereBetween('invoice_date', [now()->startOfWeek()->subMonths(2), now()->endOfWeek()])
                ->groupBy('weekNum')
                ->get()
                ->groupBy('weekNum');
        } else {
            for ($i = 1; $i <= 12; $i++) {
                $labels[] = $i;
            }

            $invoices = Invoice::select([\DB::raw('MONTH(invoice_date) as month, SUM(sum) as sum')])
                ->withCount('items')
                ->whereYear('invoice_date', request('year'))
                ->groupBy('month')
                ->get()
                ->groupBy('month');
        }

        $results['datasets']['0']['label'] = 'Zahl der Aufträge';
        $results['datasets']['1']['label'] = 'Betrag in Euro';

        foreach($labels as $label) {
            $results['labels'][] = request('groupBy') == 'week' ? trans('admin.KW') . $label : \Date::monthName($label, false);
            $results['datasets']['0']['values'][] = isset($invoices[$label]) ? $invoices[$label]->first()->items_count : 0;
            $results['datasets']['1']['values'][] = isset($invoices[$label]) ? $invoices[$label]->first()->sum : 0;
        };

        return $results;
    }

    public function getEmployeesByLocation()
    {
        $locations = \DB::table('locations')->pluck('name');

        $statement = $locations->map(function ($location) {
            return 'SUM(IF(INSTR(locations, "' . $location . '"), 1, 0)) as ' . $location;
        })->toArray();

        $employees = Employee::selectRaw(implode(', ', $statement))
            ->active()
            ->get();

        return (collect($employees[0])->map(function($employee) {
            return $employee;
        }));
    }

}
