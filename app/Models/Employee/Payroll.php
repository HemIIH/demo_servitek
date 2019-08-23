<?php

namespace App\Models\Employee;

use App\Models\User\User;
use App\Models\Scopes\Datable;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use Datable;

    protected $table = 'payroll_modifications';

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'editor');
    }

    /*
    |--------------------------------------------------------------------------
    |       Methods
    |--------------------------------------------------------------------------
    */

    public static function generate($employee, $date)
    {
        $data['payroll_modifications'] = $employee->payrollmodifications()
            ->groupBy('type')
            ->byDate($date)
            ->get(['type', \DB::raw('SUM(amount) AS amount')]);

        $data['extra_business'] = $employee->extraBusiness()
            ->groupBy('type')
            ->byDate($date)
            ->get(['type', \DB::raw('SUM(total_min) AS total_min')]);

        $timeoff = $employee->timeoff()
            ->byDate($date)
            ->get();

        $data['timeoff'] = Timeoff::combine($timeoff);

        $data['timetrackings'] = $employee->timetrackings()
            ->with('order')
            ->where('total_min', '>', 0)
            ->byDate($date)
            ->get();

        return $data;
    }

}
