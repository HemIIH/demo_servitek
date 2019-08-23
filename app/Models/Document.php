<?php

namespace App\Models;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function owner()
    {
        return $this->morphTo('with_documents');
    }

    /*
    |--------------------------------------------------------------------------
    |       Accessors and Mutators
    |--------------------------------------------------------------------------
    */

    public function setValidToAttribute($value)
    {
        if (! $value) {
            $this->attributes['valid_to'] = null;
        } else {
            $this->attributes['valid_to'] = toSql($value);
        }
    }
}
