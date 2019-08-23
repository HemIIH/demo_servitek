<?php

namespace App\Http\Requests\Order;

use App\Http\Requests\Request;

class CalculationRequest extends Request
{
    public function rules()
    {
        return [
            'hours'       => 'required|decimal',
            'other_costs' => 'decimal'
        ];
    }

    public function save($order)
    {
        $employees = $order->employees('approved_by_employee')->get();

        $total_costs  = 0;
        $total_income = 0;

        $hours = convert($this->get('hours'));
        $costs = (float) convert($this->get('other_costs', 0));

        foreach ($employees as $employee) {
            $wage = $employee->wages()->validAt($order->start_date)->first()->amount;
            $rate = $order->client->rates()->validAt($order->start_date)->first()->amount;

            $total_costs += $wage * $hours * config('settings.staff_cost_factor')[$employee->occupation_type];
            $total_income += $rate * $hours;
        }

        $total_costs += $costs;


        $order->calculation()->updateOrCreate(['order_id' => $order->id], [
            'hours'        => $hours,
            'other_costs'  => $costs,
            'total_income' => $total_income,
            'total_costs'  => $total_costs
        ]);
    }
}
