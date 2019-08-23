<?php

namespace App\Http\Requests\Employee\WorkingHours;

use App\Http\Requests\Request;

class CreateWorkingHoursRequest extends Request
{
    public function rules()
    {
        return [
            'hours'      => 'required|decimal',
            'valid_from' => 'required|date|date_format:"d.m.Y"',
        ];
    }

    public function conditionalRules()
    {
        $employee = $this->route('employee');

        $latestEntry = $employee->workingHours()->latest()->first();

        if ($latestEntry) {
            $this->conditionalRules[] = [
                'fields'   => 'valid_from',
                'rules'    => '|after:' . \Date::format($latestEntry->valid_from),
            ];
        }

        return $this->conditionalRules;
    }

    public function store($employee)
    {
        $this->updatePreviousEntry($employee);

        $employee->workingHours()->create($this->only([
            'valid_from',
            'hours'
        ]));
    }

    /**
     * Update 'valid_to' from previous rate.
     *
     * @param $employee
     */
    protected function updatePreviousEntry($employee)
    {
        if ($employee->workingHours()->exists()) {
            $latestEntry = $employee->workingHours()->latest('valid_from')->first();

            $latestEntry->update([
                'valid_to' => carbon($this->get('valid_from'))->subDay()->format('d.m.Y')
            ]);
        }
    }
}