<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Activation\ActivationService;

class AuthController extends Controller
{

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function activate(ActivationService $activationService, $token)
    {
        $activationService->activateUser($token);

        success('user_activated');

        return redirect()->to('login');
    }
}
