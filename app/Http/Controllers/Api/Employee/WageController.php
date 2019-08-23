<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Requests\Employee\Wage\CreateWageRequest;
use App\Http\Requests\Employee\Wage\UpdateWageRequest;
use App\Models\Employee\Employee;
use App\Http\Controllers\Controller;
use App\Models\Employee\Wage;

class WageController extends Controller
{

    /**
     * Get all entries from the wages table for an employee.
     *
     * @param Employee $employee
     * @return mixed
     */
    public function all(Employee $employee)
    {
        return $employee->wages()->get();
    }

    /**
     * Add an entry in the extra business table.
     *
     * @param CreateWageRequest $request
     * @param Employee $employee
     */
    public function add(CreateWageRequest $request, Employee $employee)
    {
        $request->store($employee);
    }

    /**
     * Update an entry in the wages table.
     *
     * @param UpdateWageRequest $request
     * @param Employee $employee
     * @param Wage $wage
     */
    public function update(UpdateWageRequest $request, Employee $employee, Wage $wage)
    {
        $request->save($employee, $wage);
    }

    /**
     * Delete an entry in the extra business table.
     *
     * @param Employee $employee
     * @param Wage $wage
     */
    public function delete(Employee $employee, Wage $wage)
    {
        $latestWage = $employee->wages()->latest('valid_from')->first();

        if ($latestWage->id != $wage->id) {
            return;
        }

        $wage->delete();

        if ($employee->wages()->count()) {
            $employee->wages()->latest('valid_from')->first()->update([
                'valid_to' => null
            ]);
        }
    }
}
