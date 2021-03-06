<?php

namespace App\Http\Middleware;

use Closure;

class UserIsAvenger
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
        if (Portals::isAvenger($request->ip())) {
            return $next($request);
        }else {
            abort(403, 'Adonde vas, que no te puedo acompañar');
        }
    }
}
