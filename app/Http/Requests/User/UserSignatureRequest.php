<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UserSignatureRequest extends Request
{

    public function rules()
    {
        return [
            'signature' => 'min:12'
        ];
    }

    public function save()
    {
        $user = auth()->user();

        $user->update([
            'signature' => $this->get('signature')
        ]);
    }

}
