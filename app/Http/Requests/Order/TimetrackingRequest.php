<?php

namespace App\Http\Requests\Timetracking;

use App\Http\Requests\Request;
use App\Models\Order\Order;
use App\Models\Order\Timetracking;

class TimetrackingRequest extends Request
{

    public function rules()
    {
        return [
            'start_time.*.*' => 'time',
            'end_time.*.*'   => 'time',
            'break.*.*'      => 'integer',
        ];
    }

    public function save(Order $order)
    {
        $timetrackings = $order->timetrackings;

        foreach ($timetrackings->pluck('employee_id')->unique() as $employee_id) {

            foreach ($timetrackings->pluck('date')->unique() as $date) {

                $timetracking = Timetracking::where('order_id', $order->id)
                    ->where('employee_id', $employee_id)
                    ->where('date', $date)->first();

                $start = \Time::sanitze($this->input('start_time.' . $date . '.' . $employee_id));
                $end   = \Time::sanitze($this->input('end_time.' . $date . '.' . $employee_id));
                $break = $this->isEmptyString('break.' . $date . '.' . $employee_id)  ? 0 : $this->input('break.' . $date . '.' . $employee_id);

                $data = [
                    'start_time' => $start,
                    'end_time'   => $end,
                    'break'      => $break,
                    'total_min'  => \Time::calculateDiffInMin($start, $end, $break)
                ];

                if ($data['total_min'] < 0) {
                    continue;
                }

                $timetracking->update($data);
            }

        };
    }

}
