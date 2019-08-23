<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Services\Activation\ActivationService;

class AccountController extends Controller
{

    /**
     * Activate account.
     *
     * @param User $user
     */
    public function activate(User $user)
    {
        $user->update(['active' => 1]);
    }

    /**
     * Deactivate account.
     *
     * @param User $user
     */
    public function deactivate(User $user)
    {
        $user->update(['active' => 0]);
    }

    /**
     * Resend activation mail.
     *
     * @param User $user
     * @param ActivationService $activation
     */
    public function resendCredentials(User $user, ActivationService $activation)
    {
        $user->update([
            'active'     => 0,
            'password'   => bcrypt($password = str_random(10))
        ]);

        // send mail to employee
        $activation->sendActivationMail($user, $password);
    }

}
