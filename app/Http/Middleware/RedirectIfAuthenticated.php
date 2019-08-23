<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
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

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $type = auth()->user()->type;

            return redirect()->to($this->redirectTo[$type]);
        }

        return $next($request);
    }
}
