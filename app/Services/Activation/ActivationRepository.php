<?php

namespace App\Services\Activation;

use App\Models\User\Activation;

class ActivationRepository {


    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    public function createActivation($user)
    {
        $activation = $this->getActivation($user);


        if (!$activation) {
            return $this->createToken($user);
        }

        return $this->regenerateToken($user);

    }

    private function regenerateToken($user)
    {
        $token = $this->getToken();

        Activation::where('user_id', $user->id)->update([
            'token' => $token,
            'created_at' => now()
        ]);

        return $token;
    }

    private function createToken($user)
    {
        $token = $this->getToken();

        Activation::create([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => now()
        ]);

        return $token;
    }

    public function getActivation($user)
    {
        return Activation::where('user_id', $user->id)->first();
    }


    public function getActivationByToken($token)
    {
        return Activation::where('token', $token)->first();
    }

    public function deleteActivation($token)
    {
        Activation::where('token', $token)->delete();
    }

}