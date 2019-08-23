<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    protected $table = 'order_calculation';

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

}
