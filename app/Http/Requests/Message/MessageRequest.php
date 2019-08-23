<?php

namespace App\Http\Requests\Message;

use App\Http\Requests\Request;
use Carbon\Carbon;

class MessageRequest extends Request
{
    public function rules()
    {
        return [
            'subject'     => 'required',
            'topic'       => 'required',
            'body'        => 'required'
        ];
    }
}
