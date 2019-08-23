<?php

namespace App\Http\Controllers\Employee;

use App\Models\Employee\Timeoff;
use App\Http\Controllers\Controller;

class PayrollController extends Controller
{
    protected $employee;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->employee = auth()->user()->employee;

            return $next($request);
        });
    }

    /**
     * Generate a monthly payroll as pdf including all data for the month for one employee.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $date = \Carbon\Carbon::create(request('year'), request('month'));

        $data['payroll_modifications'] = $this->employee->payrollmodifications()
            ->groupBy('type')
            ->byDate($date)
            ->get(['type', \DB::raw('SUM(amount) AS amount')]);

        $data['extra_business'] = $this->employee->extraBusiness()
            ->groupBy('type')
            ->byDate($date)
            ->get(['type', \DB::raw('SUM(total_min) AS total_min')]);

        $timeoff = $this->employee->timeoff()
            ->byDate($date)
            ->get();

        $data['timeoff'] = Timeoff::combine($timeoff);

        $data['timetrackings'] = $this->employee->timetrackings()
            ->with('order')
            ->where('total_min', '>', 0)
            ->byDate($date)
            ->get();

        return \PDF::setPaper('A4')
            ->loadView('pdf.payroll', $data, ['employee' => $this->employee, 'date' => $date])
            ->stream('Monatsabrechung.pdf');
    }

}