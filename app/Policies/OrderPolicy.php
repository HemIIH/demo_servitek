<?php

namespace App\Policies;

use App\Models\User\User;
use App\Models\Order\Order;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('master_admin')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the order.
     *
     * @param  \App\Models\User\User  $user
     * @param  \App\Models\Order\Order  $order
     * @return mixed
     */
    public function view(User $user, Order $order)
    {
        //
    }

    /**
     * Determine whether the user can create orders.
     *
     * @param  \App\Models\User\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the order.
     *
     * @param  \App\Models\User\User  $user
     * @return mixed
     */
    public function update(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the order.
     *
     * @param  \App\Models\User\User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return false;
    }

    public function timetrack(User $user, Order $order)
    {
        if ($user->hasRole('local_manager')) {
            return true;
        }

        return false;
    }
}
