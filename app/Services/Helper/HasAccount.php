<?php

namespace App\Services\Helper;

use App\Models\User\User;
use App\Services\Activation\ActivationService;

trait HasAccount
{

    /**
     * Create account.
     *
     * @param $resource
     * @param ActivationService $activation
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAccount($resource, ActivationService $activation)
    {
        $user = User::create([
            'name'       => request('name'),
            'email'      => request('email'),
            'password'   => bcrypt($password = str_random(12)),
            'type'       => $this->userType,
            'active'     => 1,
            'created_by' => auth()->user()->id
        ]);

        $resource->update([
            'user_id' => $user->id
        ]);

        // send mail to client
        $activation->sendActivationMail($user, $password);
    }

}