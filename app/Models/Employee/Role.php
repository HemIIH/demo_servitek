<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_role', 'role_id', 'employee_id');
    }

}
