<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table = 'notifications';

    /*
    |--------------------------------------------------------------------------
    |       Methods
    |--------------------------------------------------------------------------
    */

    public static function byType($type)
    {
        return self::where('notifiable_type', 'like', '%' . $type . '%')->pluck('data');
    }

    public static function dismiss($type, $id)
    {
        return self::where('notifiable_type', 'like', '%' . $type . '%')
            ->where('notifiable_id', $id)->delete();
    }


}
