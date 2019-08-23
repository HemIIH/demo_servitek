<?php

namespace App\Policies;

use App\Models\User\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('master_admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the user list.
     *
     * @return mixed
     */
    public function view()
    {
        return false;
    }

    /**
     * Determine whether the user can create users.
     *
     * @return mixed
     */
    public function create()
    {
        return false;
    }

    /**
     * Determine whether the user can update the user.
     *
     * @param  \App\Models\User\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        if ($user->hasRole('local_manager')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the user.
     *
     * @param  \App\Models\User\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        //
    }

    /**
     * Determine whether the user can manage user roles.
     *
     * @return mixed
     */
    public function manageRoles()
    {
        return false;
    }
}
