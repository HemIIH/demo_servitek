<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Services\Helper\HasAccount;
use App\Models\Employee\Employee;
use App\Models\Order\Repos\TimetrackingRepository;

use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    use HasAccount;

    protected $userType = 'employee';

    /**
     * Show all employees.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.employees.list');
    }

    /**
     * Show single employee.
     *
     * @param Employee $employee
     * @return \Illuminate\View\View
     */
    public function show(Employee $employee)
    {
        return view('admin.employees.show')
            ->with('employee', $employee);
    }

    /**
     * Show employee's history.
     *
     * @param Employee $employee
     * @return \Illuminate\View\View
     */
    public function history(Employee $employee, TimetrackingRepository $timetracking)
    {
        $data['timetrackings_by_client'] = $timetracking->groupedByClient($employee);
        $data['timetrackings_by_date']   = $timetracking->groupedByDate('employee', $employee);
        $data['orders']                  = $employee->orders()->active()->approved()->with(['client', 'timetrackings' => function($query) use ($employee) {
            $query->where('employee_id', $employee->id);
        }])->get();

        return view('admin.employees.history', $data)
            ->with('employee', $employee);
    }

    /**
     * Show employee profile.
     *
     * @param Employee $employee
     * @return \Illuminate\View\View
     */
    public function profile(Employee $employee)
    {
        $data['countries'] = \DB::table('countries')->get();

        return view('admin.employees.profile', $data)
            ->with('employee', $employee);
    }

    /**
     * Show financial related data.
     *
     * @param Employee $employee
     * @return \Illuminate\View\View
     */
    public function financials(Employee $employee)
    {
        return view('admin.employees.financials')
            ->with('employee', $employee);
    }

    /**
     * Show account.
     *
     * @param Employee $employee
     * @return \Illuminate\View\View
     */
    public function account(Employee $employee)
    {
        return view('admin.employees.account')
            ->with('employee', $employee->load('user'));
    }

    /**
     * Create/show documents for employee.
     *
     * @param Employee $employee
     * @return \Illuminate\View\View
     */
    public function documents(Employee $employee)
    {
        return view('admin.employees.documents')
            ->with('employee', $employee);
    }
}
