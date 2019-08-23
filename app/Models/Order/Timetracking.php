<?php

namespace App\Models\Order;

use App\Events\TimetrackingUpdated;
use App\Models\Employee\Employee;
use App\Models\Scopes\Datable;
use Illuminate\Database\Eloquent\Model;

class Timetracking extends Model
{
    use Datable;

    protected $guarded = [];

    public $timestamps = false;

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    /*
    |--------------------------------------------------------------------------
    |       Methods
    |--------------------------------------------------------------------------
    */

    public static function updateEntries(Order $order)
    {
        $employees = $order->employees()->approved()->get();

        self::deleteOutdatedEntries($order, $employees);

        $diffInDays = carbon($order->end_date)->diffInDays(carbon($order->start_date));

        foreach ($employees as $employee) {

            for ($i = 0; $i <= $diffInDays; $i++) {
                $entry = self::updateOrCreate([
                    'order_id'    => $order->id,
                    'employee_id' => $employee->id,
                    'date'        => carbon($order->start_date)->addDays($i)->format('Y-m-d')
                ]);

                if ($entry->wasRecentlyCreated) {
                    $entry->update([
                        'start_time'  => $order->start_time,
                        'end_time'    => $order->end_time ?: null,
                    ]);
                }
            }
        }

        event(new TimetrackingUpdated($order));
    }

    /**
     * Delete outdated entries in the timetracking table.
     *
     * @param Order $order
     * @param $employees
     */
    public static function deleteOutdatedEntries(Order $order, $employees)
    {
        $order->timetrackings()
            ->where(function ($query) use ($order, $employees) {
                $query->whereNotIn('employee_id', $employees->pluck('id'))
                      ->orWhereNotBetween('date', [$order->start_date, $order->end_date]);
            })
            ->delete();
    }
}
