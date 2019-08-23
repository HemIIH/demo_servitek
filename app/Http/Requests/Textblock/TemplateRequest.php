<?php

namespace App\Http\Requests\Textblock;

use App\Http\Requests\Request;
use App\Models\Settings\Template;

class TemplateRequest extends Request
{

    public function rules()
    {
        return [
            'body' => 'required'
        ];
    }

    public function save($name)
    {
        Template::where('name', $name)
            ->update([
                'text' => $this->get('body')
            ]);
    }
}
