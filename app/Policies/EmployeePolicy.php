<?php

namespace App\Policies;

use App\Models\User\User;
use App\Models\Employee\Employee;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmployeePolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->hasRole('master_admin') || $user->hasRole('accountant')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the employee.
     *
     * @param  User  $user
     * @param  Employee  $employee
     * @return mixed
     */
    public function view(User $user, Employee $employee)
    {
        return false;
    }

    /**
     * Determine whether the user can create employees.
     *
     * @param  User  $user
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
     * Determine whether the user can update the employee.
     *
     * @param  User  $user
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
     * Determine whether the user can delete the employee.
     *
     * @param  User  $user
     * @return mixed
     */
    public function delete(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can view/edit the employee's document area.
     *
     * @param  User  $user
     * @param  Employee $employee
     * @return mixed
     */
    public function documents(User $user, Employee $employee)
    {
        if ($user->hasRole('local_manager')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view/edit the employee's invoice area.
     *
     * @param  User  $user
     * @param  Employee $employee
     * @return mixed
     */
    public function financials(User $user, Employee $employee)
    {
        if ($user->hasRole('local_manager')) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can view/edit the employee's settings area.
     *
     * @param  User  $user
     * @param  Employee $employee
     * @return mixed
     */
    public function settings(User $user, Employee $employee)
    {
        if ($user->hasRole('local_manager')) {
            return true;
        }

        return false;
    }
}
