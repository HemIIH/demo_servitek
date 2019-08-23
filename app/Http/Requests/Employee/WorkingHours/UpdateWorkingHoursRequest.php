<?php

namespace App\Http\Requests\Employee\WorkingHours;

use App\Http\Requests\Request;

class UpdateWorkingHoursRequest extends Request
{
    public function rules()
    {
        return [
            'hours'      => 'required|decimal',
            'valid_from' => 'required|date|date_format:"d.m.Y"',
            'valid_to'   => 'date|date_format:"d.m.Y"|after:valid_from'
        ];
    }

    public function conditionalRules()
    {
        $employee    = $this->route('employee');
        $workinghour = $this->route('hour');

        $workinghours = $employee->workinghours()->latest('valid_from')->get();

        if ($workinghours->first()->id != $workinghour->id) {
            $nextEntry = $this->getNextEntry($workinghours, $workinghour);

            $this->conditionalRules[] = [
                'fields'   => 'valid_to',
                'rules'    => '|before:' . \Date::format($nextEntry->valid_to),
                'callback' => evaluate($nextEntry->valid_to)
            ];
        }

        if ($workinghours->last()->id != $workinghour->id) {
            $prevEntry = $this->getPrevEntry($workinghours, $workinghour);

            $this->conditionalRules[] = [
                'fields'   => 'valid_from',
                'rules'    => '|after:' . \Date::format($prevEntry->valid_from),
            ];
        }

        return $this->conditionalRules;
    }

    public function save($employee, $workinghour)
    {
        $this->updateEntries($employee);

        $workinghour->update($this->only([
            'valid_from',
            'valid_to',
            'hours'
        ]));
    }

    /**
     * Update 'valid_to' from previous workinghour.
     *
     * @param $employee
     */
    protected function updateEntries($employee)
    {
        $workinghour = $this->route('hour');

        $workinghours = $employee->workinghours()->latest('valid_from')->get();

        if ($workinghours->first()->id != $workinghour->id) {
            $nextEntry = $this->getNextEntry($workinghours, $workinghour);

            $nextEntry->update([
                'valid_from' => carbon($this->get('valid_to'))->addDay()->format('d.m.Y')
            ]);
        }

        if ($workinghours->last()->id != $workinghour->id) {
            $prevRate = $this->getPrevEntry($workinghours, $workinghour);

            $prevRate->update([
                'valid_to' => carbon($this->get('valid_from'))->subDay()->format('d.m.Y')
            ]);
        }
    }

    /**
     * @param $workinghours
     * @param $workinghour
     * @return mixed
     */
    protected function getNextEntry($workinghours, $workinghour)
    {
        return $workinghours->where('valid_from', '=', carbon($workinghour->valid_to)->addDay()->format('Y-m-d'))->first();
    }

    /**
     * @param $workinghours
     * @param $workinghour
     * @return mixed
     */
    protected function getPrevEntry($workinghours, $workinghour)
    {
        return $workinghours->where('valid_to', '=', carbon($workinghour->valid_from)->subDay()->format('Y-m-d'))->first();
    }
}
