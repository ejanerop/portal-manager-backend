<?php

namespace App\Http\Middleware;

use App\Util\Portals;
use Closure;

class UserIsAllowed
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
        if (Portals::isAllowed($request->ip())) {
            return $next($request);
        }else {
            abort(403, 'Adonde vas, que no te puedo acompañar');
        }
    }
}
