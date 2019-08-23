<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\Request;

class TimeOffRequest extends Request
{
    public function rules()
    {
        return [
            'start_date'  => 'required|date|date_format:"d.m.Y"',
            'end_date'    => 'date|date_format:"d.m.Y"|after_or_equal:start_date',
            'type'        => 'required',
            'information' => ''
        ];
    }

    public function store($employee)
    {
        $start = carbon($this->get('start_date'));
        $end   = $this->filled('end_date') ? carbon($this->get('end_date')) : carbon($this->get('start_date'));

        for ($i = $start; $i <= $end; $i->addDay(1)) {
            $data = [
                'date'        => $i->format('Y-m-d'),
                'type'        => $this->get('type'),
                'information' => $this->get('information'),
                'editor'      => $this->user()->id
            ];

            $employee->timeoff()->updateOrCreate(['date' => $data['date']], $data);;
        }
    }
}
