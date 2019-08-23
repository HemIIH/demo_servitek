<?php

namespace App\Models\Employee;

use App\Models\User\User;
use App\Models\Scopes\Datable;
use Illuminate\Database\Eloquent\Model;

class ExtraBusiness extends Model
{
    use Datable;

    protected $table = 'extra_business';

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
    |       Accessors and Mutators
    |--------------------------------------------------------------------------
    */

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = toSql($value);
    }

    public function setHoursAttribute($value)
    {
        $this->attributes['hours'] = convert($value);
    }

}