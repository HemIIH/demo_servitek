<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Requests\Employee\WorkingHours\CreateWorkingHoursRequest;
use App\Http\Requests\Employee\WorkingHours\UpdateWorkingHoursRequest;
use App\Models\Employee\Employee;
use App\Http\Controllers\Controller;
use App\Models\Employee\WorkingHours;

class WorkingHoursController extends Controller
{

    /**
     * Get all entries from the wages table for an employee.
     *
     * @param Employee $employee
     * @return mixed
     */
    public function all(Employee $employee)
    {
        return $employee->workingHours()->get();
    }

    /**
     * Add an entry in the extra business table.
     *
     * @param CreateWorkingHoursRequest $request
     * @param Employee $employee
     */
    public function add(CreateWorkingHoursRequest $request, Employee $employee)
    {
        $request->store($employee);
    }

    /**
     * Update an entry in the wages table.
     *
     * @param UpdateWorkingHoursRequest $request
     * @param Employee $employee
     * @param WorkingHours $hour
     */
    public function update(UpdateWorkingHoursRequest $request, Employee $employee, WorkingHours $hour)
    {
        $request->save($employee, $hour);
    }

    /**
     * Delete an entry in the extra business table.
     *
     * @param Employee $employee
     * @param WorkingHours $hour
     */
    public function delete(Employee $employee, WorkingHours $hour)
    {
        $hour->delete();

        if ($employee->workingHours()->count()) {
            $employee->workingHours()->latest('valid_from')->first()->update([
                'valid_to' => null
            ]);
        }
    }
}
