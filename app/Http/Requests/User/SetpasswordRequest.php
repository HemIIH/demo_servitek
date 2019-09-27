<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class SetpasswordRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password'
        ];
    }
}
