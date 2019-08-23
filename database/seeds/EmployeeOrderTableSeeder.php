<?php

use App\Events\StaffUpdatedForOrder;
use App\Events\TimetrackingUpdated;
use App\Models\Employee\Employee;
use App\Models\Order\Timetracking;
use Illuminate\Database\Seeder;

class EmployeeOrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = \App\Models\Order\Order::find([1, 2, 3]);

        // attach employees
        foreach ($orders as $order) {
            foreach (range(1, 5) as $index)   {
                $employee = Employee::find(rand(1, 6));
                $order->employees()->syncWithoutDetaching([$employee->id => [
                    'approved_by_employee' => ($index % 2),
                    'meeting_point'        => $order->meeting_point,
                    'meeting_time'         => $order->meeting_time
                ]
                ]);
            }

            Timetracking::updateEntries($order);

            $timetrackings = $order->timetrackings;

            foreach ($timetrackings->pluck('employee_id')->unique() as $employee_id) {
                foreach ($timetrackings->pluck('date')->unique() as $date) {

                    $timetracking = Timetracking::where('order_id', $order->id)
                        ->where('employee_id', $employee_id)
                        ->where('date', $date)->first();

                    $start = '11:00';
                    $end   = '21:00';
                    $break = 30 * rand(0, 4);

                    $data = [
                        'start_time' => $start,
                        'end_time'   => $end,
                        'break'      => $break,
                        'total_min'  => \Time::calculateDiffInMin($start, $end, $break)
                    ];

                    $timetracking->update($data);
                }
            };

            event(new TimetrackingUpdated($order));
            event(new StaffUpdatedForOrder($order));
        }

        $employee = Employee::find(1);

        // attach orders to one employee
        foreach (range(1, 9) as $index) {
            $order = \App\Models\Order\Order::find(rand(3, 15));
            $employee->orders()->syncWithoutDetaching([$order->id => [
                'approved_by_employee' => ($index % 2),
                'meeting_point'        => $order->meeting_point,
                'meeting_time'         => $order->meeting_time
            ]
            ]);

            event(new StaffUpdatedForOrder($order));
        }
    }
}
