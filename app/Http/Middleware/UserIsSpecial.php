<?php

namespace App\Http\Middleware;

use Closure;
use App\Util\Portals;

class UserIsSpecial
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
        if ((Portals::isSpecialUser($request->ip())) || (Portals::isSpecialUser2($request->ip()))) {
            return $next($request);
        }else {
            abort(403, 'No tienes autorización para realizar esta acción');
        }
    }
}
