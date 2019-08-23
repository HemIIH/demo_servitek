<?php

namespace App\Models\Settings\Repos;

use App\Models\Settings\Textblocks;

class TextblocksRepository
{
    /**
     * Get textblocks for a given type.
     *
     * @param $type
     * @return mixed
     */
    public function byType($type)
    {
        $textblocks = Textblocks::where('type', $type)->get();

        return $textblocks->mapWithKeys(function ($item) {
                return [$item->name => [
                    'key'   => $item->name,
                    'label' => $item->label,
                    'value' => $item->value
                ]
            ];
        });
    }

    /**
     * Get textblock for a given key.
     *
     * @param $key
     * @return mixed
     */
    public function byKey($key)
    {
        list($type, $name) = explode('.', $key);

        return Textblocks::where('type', $type)
                    ->where('name', $name)
                    ->first();
    }

}