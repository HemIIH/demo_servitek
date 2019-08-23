<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class WorkingHours extends Model
{
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->hasOne(\App\Models\User\User::class, 'id', 'editor');
    }

    /*
    |--------------------------------------------------------------------------
    |       Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeValidAt($query, $date)
    {
        return $query->where('valid_from', '<=', $date)
            ->orderBy('valid_from', 'desc');
    }

    public function scopeFor($query, $date)
    {
        return $query->where(function ($query) use ($date) {
            $query->whereBetween('valid_from', [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()])
                ->orWhereBetween('valid_to', [$date->copy()->startOfMonth(), $date->copy()->endOfMonth()]);
        });
    }



    /*
    |--------------------------------------------------------------------------
    |       Accessors and Mutators
    |--------------------------------------------------------------------------
    */

    public function setValidFromAttribute($value)
    {
        $this->attributes['valid_from'] = toSql($value);
    }

    public function setValidToAttribute($value)
    {
        if ($value) {
            $this->attributes['valid_to'] = toSql($value);
        } else {
            $this->attributes['valid_to'] = null;
        }
    }

    public function setHoursAttribute($value)
    {
        $this->attributes['hours'] = convert($value);
    }

}