<?php

namespace App\Listeners;

use App\Models\Employee\Employee;
use App\Models\Order\Repos\TimetrackingRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CalculateWorkingTimeAccounts
{

    protected $timetracking;

    /**
     * Create the event listener.
     *
     * @param TimetrackingRepository $timetracking
     */
    public function __construct(TimetrackingRepository $timetracking)
    {
        $this->timetracking = $timetracking;
    }

    /**
     * Handle the event.
     *
     * @param  $event
     * @return void
     * @throws \Exception
     */
    public function handle($event)
    {
        if (isset($event->order)) {
            $data = $event->order->timetrackings;
        } else if (isset($event->extraBusiness)) {
            $data = collect([$event->extraBusiness]);
        } else {
            return;
        }

        $data->groupBy('employee_id')->each(function($entries, $employee_id) {

            $employee = Employee::find($employee_id);

            $entries->each(function($item) use($employee) {
                $this->updateMonthlyTimeAccount($employee, carbon($item->date));
            });

            $this->updateGeneralTimeAccount($employee);
        });
    }

    /**
     * Get working time from extra business.
     *
     * @param $employee
     * @param $date
     * @return int
     */
    protected function getExtraBusinessByMonth($employee, $date)
    {
        if (! $employee->extraBusiness) return 0;

        return $employee->extraBusiness()
            ->byDate($date)
            ->sum('total_min');
    }

    /**
     * Update entries in the working time accounts table.
     *
     * @param $employee
     * @param $date
     */
    function updateMonthlyTimeAccount($employee, $date)
    {
        $total_min = $this->timetracking->totalByDate($employee, $date) + $this->getExtraBusinessByMonth($employee, $date);

        $where = [
            'date'        => $date->startofMonth()->format('Y-m-d')
        ];

        $target = $this->getTarget($employee, $date);

        $employee->workingTimeAccounts()->updateOrCreate($where ,[
            'actual'  => ($total_min / 60) ?: 0,
            'target'  => $target,
            'balance' => ($total_min / 60) - $target
        ]);
    }

    /**
     * Update entry for working time account in the employees table.
     *
     * @param $employee
     */
    protected function updateGeneralTimeAccount($employee)
    {
        $sum = $employee->workingTimeAccounts()
            ->where('date', '<', now())
            ->first([\DB::raw('SUM(target) as target, SUM(actual) as actual')]);

        $employee->update([
            'working_time_account' => $sum->actual - $sum->target
        ]);
    }

    public function getTarget($employee, $date)
    {
        try {
            return $employee->workingHours()->validAt($date)->firstOrFail()->hours;
        } catch(\Exception $e) {
            return 0;
        }
    }
}
