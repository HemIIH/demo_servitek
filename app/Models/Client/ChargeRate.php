<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class ChargeRate extends Model
{
    protected $guarded = [];

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

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = convert($value);
    }
}
