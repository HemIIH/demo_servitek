<?php

namespace App\Http\Requests\Settings;

use App\Http\Requests\Request;
use App\Models\User\Role;
use App\Models\User\User;

class AssignRoleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_id' => 'required',
            'role_id' => 'required'
        ];
    }

    /**
     * Persist data.
     */
    public function persist()
    {
        $user = User::find($this->get('user_id'));
        $role = Role::find($this->get('role_id'));

        if (! $user || ! $role) {
            return false;
        }

        $user->roles()->sync($role);

        return true;
    }
}
