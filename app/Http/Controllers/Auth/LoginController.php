<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Activation\ActivationService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = [
        'internal'  => '/admin/dashboard',
        'employee' => '/e/dashboard',
        'client' => '/c/dashboard',
    ];

    protected $activationService;

    /**
     * Create a new controller instance.
     *
     * @param ActivationService $activationService
     */
    public function __construct(ActivationService $activationService)
    {
        $this->middleware('guest', ['except' => 'logout']);

        $this->activationService = $activationService;
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = array_merge(
            $this->credentials($request),
            ['active' => 1]
        );

        return $this->guard()->attempt(
            $credentials, $request->has('remember')
        );
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        $postData = [
                    'action' => 'user.login',
                    'user' => $this->guard()->user(),
                    'domain' => config('app.domain'),
                    'timestamp' => date('Y-m-d H:i:s'),
                    'login_user_id' => $this->guard()->user()->id,
                ];
        $postJson = json_encode($postData);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => config('app.API')."user.login",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postJson,
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        

        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->to($this->redirectTo[$this->guard()->user()->type]);
    }
}
