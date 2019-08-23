<?php

namespace App\Http\Middleware;

use Closure;

class AuthInternal
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (! isset(auth()->user()->type) || auth()->user()->type != 'internal' ) {
            error('rights');

            return redirect('/login');
        }

        return $next($request);
    }
}
