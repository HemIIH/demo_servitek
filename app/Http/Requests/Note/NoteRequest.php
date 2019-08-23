<?php

namespace App\Http\Requests\Note;

use App\Http\Requests\Request;
use Carbon\Carbon;

class NoteRequest extends Request
{
    public function rules()
    {
        return [
            'month'       => 'sometimes|required|between:1,12',
            'year'        => 'sometimes|required|integer',
            'body'        => 'required'
        ];
    }

    public function store($resource)
    {
        return $resource->notes()->create($this->getData());
    }

    public function save($resource)
    {
        return $resource->notes()->where('id', $this->get('id'))->update([
            'information' => $this->get('body')
        ]);
    }

    protected function getData()
    {
        return [
            'date'        => Carbon::create($this->get('year'), $this->get('month')),
            'information' => $this->get('body'),
            'editor'      => auth()->user()->id
        ];
    }
}
