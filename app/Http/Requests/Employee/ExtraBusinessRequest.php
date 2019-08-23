<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\Request;
use App\Models\Employee\Employee;

class ExtraBusinessRequest extends Request
{
    public function rules()
    {
        return [
            'date'        => 'required|date|date_format:"d.m.Y"',
            'information' => '',
            'type'        => 'required|in:' . implode(',', array_keys(config('settings.extra_business'))),
            'hours'       => 'required|decimal'
        ];
    }

    public function store(Employee $employee)
    {
        $data = $this->getData();

        return $employee->extraBusiness()->create($data);
    }

    public function save($extraBusiness)
    {
        $extraBusiness->update($this->getData());
    }

    protected function getData()
    {
        $data = $this->only([
            'date',
            'type',
            'information',
            'hours',
        ]);

        $data['editor'] = auth()->id();
        $data['total_min'] = convert($this->get('hours')) * config('settings.extra_business')[$this->get('type')]['multiplier'] * 60;

        return $data;
    }
}
