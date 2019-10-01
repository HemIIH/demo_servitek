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
        $portValidate = DB::table('portal_settings')->select('expired_at', 'status', 'is_setup')->first();
        if($portValidate->is_setup === 0){
            return response()->view('layouts.partials.password_setup');            
        }elseif ((strtotime($portValidate->expired_at) <= strtotime(date('Y-m-d'))) || in_array($portValidate->status, ['deactive','suspend'])) {

            return response()->view('layouts.partials.portal_expired', compact('portValidate'));
        }

        return $next($request);
    }
}
