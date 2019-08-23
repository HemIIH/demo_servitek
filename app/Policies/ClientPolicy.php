<?php

namespace App\Policies;

use App\Models\User\User;
use App\Models\Client\Client;
use Illuminate\Auth\Access\HandlesAuthorization;

class ClientPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('master_admin')) {
            return true;
        }

        if ($user->hasRole('accountant')) {
            return false;
        }
    }

    /**
     * Determine whether the user can view the client.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Client\Client  $client
     * @return mixed
     */
    public function view(User $user, Client $client)
    {
        return false;
    }

    /**
     * Determine whether the user can create clients.
     *
     * @param  \App\Models\User\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if ($user->hasRole('local_manager')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the client.
     *
     * @param  \App\Models\User\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        if ($user->hasRole('local_manager') || $user->hasRole('accountant')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can delete the client.
     *
     * @return mixed
     */
    public function delete()
    {
        return false;
    }

    /**
     * Determine whether the user can view/edit the client's invoice area.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Client\Client  $client
     * @return mixed
     */
    public function financials(User $user, Client $client)
    {
        if ($user->hasRole('local_manager')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view/edit the client's settings area.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Client\Client  $client
     * @return mixed
     */
    public function settings(User $user, Client $client)
    {
        if ($user->hasRole('local_manager')) {
            return true;
        }

        return false;
    }
}
