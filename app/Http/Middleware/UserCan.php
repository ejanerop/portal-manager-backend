<?php

namespace App\Http\Middleware;

use App\Client;
use Closure;
use App\Http\Middleware\Authenticate;

class UserCan
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    */
    public function handle($request, Closure $next, $permission)
    {
        try {
            return app(Authenticate::class)->handle($request ,  function ($request) use ($next) {
                return $next($request);
            }, 'api');
        } catch (\Throwable $th) {
            $ip = $request->ip();
            $client = Client::where( 'ip_address' , $ip )->first();
            if(!$client) {
                return response()->json('Usuario no registrado', 404);
            }else {
                $permissions = $client->permissions;
                foreach ($permissions as $item) {
                    if ($item->name == $permission) {return $next($request);}
                }
                return response()->json('No tiene permiso para realizar esta acción', 403);
            }
        }

    }
}
