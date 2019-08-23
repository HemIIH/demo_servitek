<?php

namespace App\Models\Employee;

use App\Models\User\User;
use App\Models\Scopes\Datable;
use Illuminate\Database\Eloquent\Model;

class Timeoff extends Model
{
    use Datable;

    protected $table = 'time_off';

    protected $guarded = [];

    /*
    |--------------------------------------------------------------------------
    |       Relations
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        return $this->belongsTo(User::class, 'editor', 'id');
    }

    /*
    |--------------------------------------------------------------------------
    |       Methods
    |--------------------------------------------------------------------------
    */

    /**
     * Combine time offs to display them in a human friendly way.
     *
     * @param $dataset
     * @return array
     */
    public static function combine($dataset)
    {
        $output = [];

        foreach ($dataset as $key => $item) {

            if (self::isConsecutiveEntry($output, $item)) {
                array_push(end($output)['id'], $item->id);
                $output[count($output) - 1]['end'] = $item->date;
            } else {
                $output[] = [
                    'id'          => [$item->id],
                    'start'       => $item->date,
                    'end'         => $item->date,
                    'type'        => $item->type,
                    'information' => $item->information,
                    'username'    => $item->user->name
                ];
            }
        };

        usort($output, function($a, $b) {
            return strtotime($b['start']) - strtotime($a['start']);
        });

        return $output;
    }

    protected static function isConsecutiveEntry($output, $item)
    {
        return end($output) && end($output)['type'] == $item->type && carbon($item->date)->diffInDays(carbon(end($output)['end'])) == 1;
    }

}
