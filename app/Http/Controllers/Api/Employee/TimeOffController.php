<?php

namespace App\Http\Controllers\Api\Employee;

use App\Models\Employee\Timeoff;
use App\Http\Controllers\Controller;

use App\Http\Requests\Employee\TimeOffRequest;

class TimeOffController extends Controller
{
    public function get($employee)
    {
        return Timeoff::combine($employee->timeoff->load('user'));
    }

    /**
     * Add time off entry for employee.
     *
     * @param TimeOffRequest $request
     * @param $employee
     * @return \Illuminate\Http\JsonResponse
     */
    public function add(TimeOffRequest $request, $employee)
    {
        $request->store($employee);
    }

    /**
     * Delete time off entrie for employee.
     */
    public function delete($employee)
    {
        $employee->timeoff()->whereIn('id', (array) (request('entry')['id']))->delete();
    }
}
