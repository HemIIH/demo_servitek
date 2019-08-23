<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Requests\Employee\EmployeeRequest;
use App\Http\Requests\Employee\UploadEmployeePhotoRequest;
use App\Models\Employee\Employee;
use App\Http\Controllers\Controller;
use App\Services\Helper\HasNotes;

class EmployeeController extends Controller
{
    use HasNotes;

    /**
     * Get data for list view.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData()
    {
        return Employee::search()->paginateAndOrder();
    }

    /**
     * Get all employees.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        return Employee::get();
    }

    /**
     * Get single employee data.
     *
     * @param Employee $employee
     * @return Employee $employee
     */
    public function get(Employee $employee)
    {
        return $employee->load('user', 'currentWorkingTimeAccount');
    }

    /**
     * Store new employee.
     *
     * @param EmployeeRequest $request
     */
    public function store(EmployeeRequest $request)
    {
        $request->store();
    }

    /**
     * Update an employee.
     *
     * @param EmployeeRequest $request
     * @param Employee $employee
     * @return mixed
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee = $request->save($employee);

        return $employee;
    }

    /**
     * Delete an employee.
     *
     * @param Employee $employee
     * @return mixed
     */
    public function delete(Employee $employee)
    {
        if ($employee->orders()->exists())
            return false;

        $employee->delete();
    }

    /**
     * Upload employee photo.
     *
     * @param EmployeeRequest $request
     * @param Employee $employee
     */
    public function uploadPhoto(EmployeeRequest $request, Employee $employee)
    {
        $this->validate(request(), ['photo' => ['required', 'image', 'max:2000']]);

        $request->upload($employee);
    }

    /**
     * Delete employee photo.
     *
     * @param Employee $employee
     */
    public function deletePhoto(Employee $employee)
    {
        \File::delete('uploads/images/photos/' . $employee->photo);

        $employee->update(['photo' => null]);
    }

    /**
     * Update roles for an employee.
     *
     * @param Employee $employee
     */
    public function updateRoles(Employee $employee)
    {
        $employee->roles()->sync(request('roles'));
    }

}
