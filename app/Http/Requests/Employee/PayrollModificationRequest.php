<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\Request;
use App\Models\Employee\Employee;
use Carbon\Carbon;

class PayrollModificationRequest extends Request
{
    public function rules()
    {
        return [
            'month'       => 'required|between:1,12',
            'year'        => 'required|integer',
            'information' => '',
            'type'        => 'required|in:' . implode(',', array_keys(config('settings.payroll_relevant_factors'))),
            'amount'      => 'required|decimal'
        ];
    }

    public function store(Employee $employee)
    {
        $employee->payrollModifications()->create($this->getData());
    }
    
    public function save($payrollModification)
    {
        $payrollModification->update($this->getData());
    }
    
    protected function getData()
    {
        $data = [
            'date'        => Carbon::create($this->get('year'), $this->get('month')),
            'type'        => $this->get('type'),
            'information' => $this->get('information'),
            'editor'      => 1,
            'amount'      => convert($this->get('amount')) * config('settings.payroll_relevant_factors')[$this->get('type')]['sign']
        ];

        return $data;
    }
}
