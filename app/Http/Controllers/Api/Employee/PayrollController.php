<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
//use App\Events\ExtraBusinessUpdated;

use App\Http\Requests\Employee\PayrollModificationRequest;
use App\Models\Employee\Employee;
use App\Models\Employee\Payroll;

class PayrollController extends Controller
{
    /**
     * Get all entries from the extra business table for an employee.
     *
     * @param Employee $employee
     * @return mixed
     */
    public function all(Employee $employee)
    {
        return $employee->payrollModifications()->get();
    }

    /**
     * Add an entry in the extra business table.
     *
     * @param PayrollModificationRequest $request
     * @param Employee $employee
     */
    public function add(PayrollModificationRequest $request, Employee $employee)
    {
        $request->store($employee);
    }

    /**
     * Add an entry in the extra business table.
     *
     * @param PayrollModificationRequest $request
     * @param Employee $employee
     * @param Payroll $payrollModification
     */
    public function update(PayrollModificationRequest $request, Employee $employee, Payroll $payrollModification)
    {
        $request->save($payrollModification);
    }

    /**
     * Delete an entry in the extra business table.
     *
     * @param Employee $employee
     * @param Payroll $payrollModification
     */
    public function delete(Employee $employee, Payroll $payrollModification)
    {
        $payrollModification->delete();
    }

}
