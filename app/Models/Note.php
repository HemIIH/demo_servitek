<?php

namespace App\Models;

use App\Models\User\User;
use App\Models\Scopes\Datable;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use Datable;

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function loggable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'editor');
    }

}
