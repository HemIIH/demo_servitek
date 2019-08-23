<?php

namespace App\Http\Requests\User;

use App\Http\Requests\Request;

class UserCredentialsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'                 => 'required|email|unique:users,email,' . auth()->id(),
            'cc_email'              => 'sometimes|required|email',
            'name'                  => 'sometimes|required',
            'password'              => 'sometimes|confirmed',
            'password_confirmation' => 'required_with:password',
            'current_password'      => 'required',
        ];
    }

    public function save()
    {
        $user = \Auth::user();

        $credentials = [
            'email'    => $user->email,
            'password' => $this->get('current_password')
        ];

        if (! \Auth::attempt($credentials)) {
            return false;
        }

        $data = [
            'email'     => $this->get('email'),
            'name'      => $this->get('name'),
            'locations' => json_encode($this->get('locations'))
        ];

        if ($this->filled('password')) {
            $data['password'] = bcrypt($this->get('password'));
        }

        if ($this->filled('cc_email')) {
            $data['cc_email'] = $this->get('cc_email');
        }

        $user->update($data);

        return true;
    }
}
