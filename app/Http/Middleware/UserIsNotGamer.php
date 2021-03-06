<?php

namespace App\Http\Middleware;

use App\Util\Portals;
use Closure;

class UserIsNotGamer
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
        if (!Portals::isGamerUser($request->ip())) {
            return $next($request);
        }else {
            abort(403, 'No tienes autorización para realizar esta acción');
        }
    }
}
