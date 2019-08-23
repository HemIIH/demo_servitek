<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class InvoiceData extends Model
{
    protected $table = 'invoice_data';

    public $timestamps = false;

    public $guarded = [];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

}
