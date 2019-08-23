<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UserAddressRequest extends Request
{
    public function rules()
    {
        return [
            'street'      => 'required',
            'postal_code' => 'required|numeric',
            'city'        => 'required'
        ];
    }

    public function save()
    {
        $user = \Auth::user();

        $user->update([
            'street'      => $this->get('street'),
            'postal_code' => $this->get('postal_code'),
            'city'        => $this->get('city')
        ]);
    }
}
