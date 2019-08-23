<?php

namespace App\Http\Controllers\Api\Employee;

use App\Events\ExtraBusinessUpdated;
use App\Http\Controllers\Controller;
//use App\Events\ExtraBusinessUpdated;

use App\Http\Requests\Employee\ExtraBusinessRequest;
use App\Models\Employee\Employee;
use App\Models\Employee\ExtraBusiness;

class ExtraBusinessController extends Controller
{
    /**
     * Get all entries from the extra business table for an employee.
     *
     * @param Employee $employee
     * @return mixed
     */
    public function all(Employee $employee)
    {
        return $employee->extraBusiness;
    }

    /**
     * Add an entry in the extra business table.
     *
     * @param ExtraBusinessRequest $request
     * @param Employee $employee
     */
    public function add(ExtraBusinessRequest $request, Employee $employee)
    {
        $extraBusiness = $request->store($employee);

        event(new ExtraBusinessUpdated($extraBusiness));
    }

    /**
     * Add an entry in the extra business table.
     *
     * @param ExtraBusinessRequest $request
     * @param Employee $employee
     * @param ExtraBusiness $extraBusiness
     */
    public function update(ExtraBusinessRequest $request, Employee $employee, ExtraBusiness $extraBusiness)
    {
        $request->save($extraBusiness);

        event(new ExtraBusinessUpdated($extraBusiness));
    }

    /**
     * Delete an entry in the extra business table.
     *
     * @param Employee $employee
     * @param ExtraBusiness $extraBusiness
     */
    public function delete(Employee $employee, ExtraBusiness $extraBusiness)
    {
        $extraBusiness->delete();

        event(new ExtraBusinessUpdated($extraBusiness));
    }

}
