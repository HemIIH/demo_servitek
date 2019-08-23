<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;

use App\Models\Note;
use App\Models\Employee\Payroll;
use App\Models\Employee\Timeoff;
use App\Models\Employee\Employee;
use App\Models\Employee\ExtraBusiness;
use App\Models\Order\Order;
use App\Models\Order\Timetracking;

class PayrollController extends Controller
{
    /**
     * Generate a monthly payroll as pdf including all data for the month for one employee.
     *
     * @param Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function byEmployee(Employee $employee)
    {
        $date = \Carbon\Carbon::create(request('year'), request('month'));

        $data = Payroll::generate($employee, $date);

        return \PDF::setPaper('A4')
            ->loadView('pdf.payroll', $data, ['employee' => $employee, 'date' => $date])
            ->stream('Monatsabrechung.pdf');
    }


    /**
     * Generate a monthly payroll as pdf including all data for the month for all employees
     *
     * @return \Illuminate\Http\Response
     */
    public function byMonth()
    {
        $date = \Carbon\Carbon::createFromDate(request('year'), request('month'));

        $orders = Order::active()
            ->where('time_recorded', 0)
            ->whereMonth('start_date', $date->format('m'))
            ->whereYear('start_date', $date->format('Y'))
            ->pluck('id');

        $data['not_timetracked'] = \DB::table('employee_order')
            ->where('approved_by_employee', 1)
            ->whereIn('order_id', $orders)
            ->distinct('employee_id')
            ->pluck('employee_id')
            ->toArray();

        $data['timetrackings'] = Timetracking::select('employee_id', \DB::raw('SUM(total_min) AS total_min'))
            ->byDate($date)
            ->groupBy('employee_id')
            ->pluck('total_min', 'employee_id');

        $extraBusinessTotal = ExtraBusiness::select(\DB::raw("employee_id, SUM(total_min) AS total_min"))
            ->groupBy('employee_id')
            ->byDate($date)
            ->pluck('total_min', 'employee_id');

        $data['total'] = $data['timetrackings']->map(function($value, $key) use ($extraBusinessTotal) {
            return $value + (isset($extraBusinessTotal[$key]) ? $extraBusinessTotal[$key] : 0);
        });

        $data['payroll'] = Payroll::groupBy('employee_id', 'type')
            ->byDate($date)
            ->get(['employee_id', 'type', \DB::raw('SUM(amount) AS amount')])
            ->groupBy('employee_id');

        $data['notes'] = Note::where('loggable_type', 'employees')
            ->byDate($date)
            ->get([\DB::raw("loggable_id AS employee_id, information")])
            ->groupBy('employee_id');

        $data['employees'] = Employee::active()
            ->orWhereIn('id', $data['timetrackings']->keys())
            ->orderBy('last_name')->get();

        $data['extra_business'] = ExtraBusiness::groupBy('employee_id', 'type')
            ->byDate($date)
            ->get(['employee_id', 'type', \DB::raw('SUM(total_min) AS total_min')])
            ->groupBy('employee_id');

        $data['time_off'] = Timeoff::groupBy('employee_id', 'type')
            ->byDate($date)
            ->get(['employee_id', 'type', \DB::raw('COUNT(id) AS days')])
            ->groupBy('employee_id');

        // generate pdf
        return \PDF::setPaper('A4', 'landscape')
            ->loadView('pdf.output', $data, ['date' => $date])
            ->stream('Lohnabrechnung.pdf');
    }
}
