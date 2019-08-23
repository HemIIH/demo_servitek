<?php

namespace App\Http\Requests\Employee\Wage;

use App\Http\Requests\Request;

class UpdateWageRequest extends Request
{
    public function rules()
    {
        return [
            'amount'     => 'required|decimal',
            'valid_from' => 'required|date|date_format:"d.m.Y"',
            'valid_to'   => 'date|date_format:"d.m.Y"|after:valid_from'
        ];
    }

    public function conditionalRules()
    {
        $employee = $this->route('employee');
        $wage     = $this->route('wage');

        $wages = $employee->wages()->latest('valid_from')->get();

        if ($wages->first()->id != $wage->id) {
            $nextWage = $this->getNextWage($wages, $wage);

            $this->conditionalRules[] = [
                'fields'   => 'valid_to',
                'rules'    => '|before:' . \Date::format($nextWage->valid_to),
                'callback' => evaluate($nextWage->valid_to)
            ];
        }

        if ($wages->last()->id != $wage->id) {
            $prevWage = $this->getPrevWage($wages, $wage);

            $this->conditionalRules[] = [
                'fields'   => 'valid_from',
                'rules'    => '|after:' . \Date::format($prevWage->valid_from),
            ];
        }

        return $this->conditionalRules;
    }

    public function save($employee, $wage)
    {
        $this->updateWages($employee);

        $wage->update($this->only([
            'valid_from',
            'valid_to',
            'amount'
        ]));
    }

    /**
     * Update 'valid_to' from previous wage.
     *
     * @param $employee
     */
    protected function updateWages($employee)
    {
        $wage = $this->route('wage');

        $wages = $employee->wages()->latest('valid_from')->get();

        if ($wages->first()->id != $wage->id) {
            $nextWage = $this->getNextWage($wages, $wage);

            $nextWage->update([
                'valid_from' => carbon($this->get('valid_to'))->addDay()->format('d.m.Y')
            ]);
        }

        if ($wages->last()->id != $wage->id) {
            $prevRate = $this->getPrevWage($wages, $wage);

            $prevRate->update([
                'valid_to' => carbon($this->get('valid_from'))->subDay()->format('d.m.Y')
            ]);
        }
    }

    /**
     * @param $wages
     * @param $wage
     * @return mixed
     */
    protected function getNextWage($wages, $wage)
    {
        return $wages->where('valid_from', '=', carbon($wage->valid_to)->addDay()->format('Y-m-d'))->first();
    }

    /**
     * @param $wages
     * @param $wage
     * @return mixed
     */
    protected function getPrevWage($wages, $wage)
    {
        return $wages->where('valid_to', '=', carbon($wage->valid_from)->subDay()->format('Y-m-d'))->first();
    }
}
