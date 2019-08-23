<?php

namespace App\Models;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class MailLog extends Model
{
    protected $table = 'mail_log';

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function mails()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'sent_by');
    }

}
