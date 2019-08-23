<?php

namespace App\Http\Requests\Textblock;

use App\Http\Requests\Request;

class TextblockRequest extends Request
{
    public function rules()
    {
        $keys = collect($this->all())->keys();

        $rules = $keys->mapWithKeys(function($item) {
            return [$item => 'required'];
        });

        return $rules->toArray();
    }

    public function save($type)
    {
        collect($this->all())->each(function ($value, $key) use ($type) {
            \DB::table('textblocks')
                ->where('type', $type)
                ->where('name', $key)
                ->update([
                    'value' => $value
                ]);
        });
    }
}
