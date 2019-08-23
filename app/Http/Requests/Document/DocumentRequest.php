<?php

namespace App\Http\Requests\Document;

use App\Http\Requests\Request;

abstract class DocumentRequest extends Request
{

    public function rules()
    {
        $keys = collect($this->all())->keys();

        $rules = $keys->mapWithKeys(function($item) {
            if (str_contains($item, 'date') || $item == 'valid_to') {
                return [$item => 'required|date|date_format:"d.m.Y"'];
            } else {
                return [$item => 'required'];
            }
        });

        return $rules->toArray();
    }

    public function store($resource, $name)
    {
        $template = $this->template->byName($name);

        $path = $this->storeDocument($template, $resource);

        $resource->documents()->create([
            'name'        => $template->title,
            'path'        => $path,
            'created_by'  => auth()->user()->id
        ]);
    }

    public function save($resource, $document)
    {
        $data = [
            'name'     => $this->get('name'),
            'valid_to' => $this->get('valid_to')
        ];

        $document->update($data);
    }

}
