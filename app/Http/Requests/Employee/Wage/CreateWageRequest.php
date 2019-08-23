<?php

namespace App\Http\Requests\Employee\Wage;

use App\Http\Requests\Request;

class CreateWageRequest extends Request
{
    public function rules()
    {
        return [
            'amount'     => 'required|decimal',
            'valid_from' => 'required|date|date_format:"d.m.Y"',
        ];
    }

    public function conditionalRules()
    {
        $employee = $this->route('employee');

        $latestRate = $employee->wages()->latest()->first();

        if ($latestRate) {

            $this->conditionalRules[] = [
                'fields'   => 'valid_from',
                'rules'    => '|after:' . \Date::format($latestRate->valid_from),
            ];
        }

        return $this->conditionalRules;
    }

    public function store($employee)
    {
        $this->updatePreviousWage($employee);

        $employee->wages()->create($this->only([
            'valid_from',
            'amount'
        ]));
    }

    /**
     * Update 'valid_to' from previous rate.
     *
     * @param $employee
     */
    protected function updatePreviousWage($employee)
    {
        if ($employee->wages()->exists()) {
            $latestEntry = $employee->wages()->latest('valid_from')->first();

            $latestEntry->update([
                'valid_to' => carbon($this->get('valid_from'))->subDay()->format('d.m.Y')
            ]);
        }
    }
}