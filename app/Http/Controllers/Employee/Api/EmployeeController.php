<?php

namespace App\Http\Controllers\Employee\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\EmployeeRequest;

class EmployeeController extends Controller
{
    protected $employee;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->employee = auth()->user()->employee;

            return $next($request);
        });
    }

    public function get()
    {
        return $this->employee;
    }

    public function update(EmployeeRequest $request)
    {
        $request->save($this->employee);
    }

    public function payroll()
    {
        return $this->employee->payrollModifications()->get();
    }

    public function extraBusiness()
    {
        return $this->employee->extraBusiness()->get();
    }
}