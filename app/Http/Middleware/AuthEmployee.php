<?php

namespace App\Http\Middleware;

use Closure;

class AuthEmployee
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! isset(auth()->user()->employee) || auth()->user()->type != 'employee' ) {
            error('rights');

            return redirect('logout');
        }

        return $next($request);
    }
}
