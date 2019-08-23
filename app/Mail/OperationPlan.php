<?php

namespace App\Mail;

use App\Models\Employee\Employee;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OperationPlan extends Mailable
{
    use Queueable, SerializesModels;

    protected $employee;

    protected $orders;

    protected $dates;

    /**
     * Create a new message instance.
     *
     * @param Employee $employee
     * @param $orders
     * @param $dates
     */
    public function __construct(Employee $employee, $orders, $dates)
    {
        $this->employee  = $employee;
        $this->orders    = $orders;
        $this->dates     = $dates;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $employee = $this->employee;

        return $this->subject('Servite GmbH - Einsatzplan: ' . \Date::timespan($this->dates['start'], $this->dates['end']))
                    ->from(auth()->user()->email)
                    ->to($employee->email)
                    ->bcc(auth()->user()->cc_email)
                    ->view('emails.employees.operation_plan', ['employee' => $this->employee, 'orders' => $this->orders]);
    }
}
