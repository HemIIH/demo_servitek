<?php

namespace App\Employee;

use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Model;

class TimeoffRequest extends Model
{
    protected $table = 'time_off_request';

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
