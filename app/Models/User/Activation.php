<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Activation extends Model
{
    protected $table = 'user_activations';

    protected $guarded = [];

    public $timestamps = false;

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    |       Accessors and Mutators
    |--------------------------------------------------------------------------
    */

    /**
     * Disable updated at field.
     *
     * @param $value
     */
    public function setUpdatedAtAttribute($value) {}

}