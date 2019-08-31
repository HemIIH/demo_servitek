<?php

namespace App\Http\Middleware;

use Closure;
use DB;

class PortalValidate
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
        $portValidate = DB::table('portal_settings')->select('expired_at', 'status')->first();
        if ((strtotime($portValidate->expired_at) <= strtotime(date('Y-m-d'))) || $portValidate->status == 'deactive') {

            return response()->view('layouts.partials.portal_expired');
        }

        return $next($request);
    }
}
