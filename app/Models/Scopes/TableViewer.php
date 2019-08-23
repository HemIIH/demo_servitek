<?php

namespace App\Models\Scopes;

use Validator;

trait TableViewer
{
    public function scopePaginateAndOrder($query)
    {
        $rules = [
            'column'          => 'required|alpha_dash',
            'direction'       => 'required|in:asc,desc'
        ];

        $v = Validator::make(request()->only([
            'column', 'direction'
        ]), $rules);

        if ($v->fails()) {
            throw new \Illuminate\Validation\ValidationException($v);
        }

        return $query->orderBy(request('column'), request('direction'))->paginate(20);
    }

}