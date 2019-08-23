<?php

namespace App\Services\Activation;


use App\Models\User\User;
use App\Mail\User\UserActivation;

class ActivationService
{

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(ActivationRepository $activationRepo)
    {
        $this->activationRepo = $activationRepo;
    }

    /**
     * Send activation mail.
     *
     * @param $user
     * @param $password
     */
    public function sendActivationMail($user, $password)
    {
        $token = $this->activationRepo->createActivation($user);

        \Mail::to($user->email)->send(new UserActivation($token, $password));
    }

    /**
     * Attempt to activate user.
     *
     * @param $token
     * @return $user
     */
    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->update([
            'active'    => true,
            'activated' => true
        ]);

        $this->activationRepo->deleteActivation($token);

        return $user;
    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);

        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}
