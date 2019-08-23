<?php

namespace App\Http\Controllers\Admin\Employee;

use App\Http\Controllers\Controller;

use App\Mail\OperationPlan;

use App\Models\Order\Order;
use App\Models\Employee\Employee;
use App\Services\Helper\LogMailTraffic;

class OperationPlanController extends Controller
{
    use LogMailTraffic;

    /**
     * Send operation plans to employees according to date.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send()
    {
        $employees = Employee::whereIn('id', (array) request('employees'))->get();


        $dates = [
            'start' => carbon(request('start'))->format('Y-m-d'),
            'end'   => carbon(request('end'))->format('Y-m-d'),
            'week'  => carbon(request('start'))->format('W')
        ];

        $this->sendMails($employees, $dates);

        return redirect()->back();
    }

    /**
     * Send operation plans to all assigned employees in an order.
     *
     * @param Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendByOrderLevel(Order $order)
    {
        $dates = [
            'start' => carbon($order->start_date)->startOfWeek()->format('Y-m-d'),
            'end'   => carbon($order->start_date)->endOfWeek()->format('Y-m-d'),
            'week'  => carbon($order->start_date)->format('W')
            ];

        $this->sendMails($order->employees, $dates);

        success('mails_sent');

        return redirect()->back();
    }

    /**
     * Send operation plans to employees.
     *
     * @param $employees
     * @param $dates
     */
    protected function sendMails($employees, $dates)
    {
        $employees->each(function ($employee) use ($dates) {
            $orders = $employee->orders('asc')
                ->with('client')
                ->where(function($query) use ($dates) {
                    $query->whereBetween('start_date', [$dates['start'], $dates['end']])
                          ->orWhereBetween('end_date', [$dates['start'], $dates['end']]);
                })
                ->get();

            if (! $orders)
                return;

            \Mail::send(new OperationPlan($employee, $orders, $dates));

            \Debugbar::info('Mail verschickt an ' . $employee->last_name . ', ' . $employee->first_name . '. Verschickt für den Zeitraum ' . $dates['start'] . ' bis ' . $dates['end'] . '.');

            $this->updateSendingStatus($employee, $orders);
        });
    }

    /**
     * Update sending status for each employee <-> order relation.
     *
     * @param $employee
     * @param $orders
     */
    protected function updateSendingStatus($employee, $orders)
    {
        $orders->each(function ($order) use ($employee) {
            $employee->orders()->updateExistingPivot($order->id, [
                'sent'    => date("Y-m-d H:i:s"),
                'sent_by' => auth()->user()->name
            ]);
        });
    }

}