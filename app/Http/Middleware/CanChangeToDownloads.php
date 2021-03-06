<?php

namespace App\Http\Middleware;

use App\Gamer;
use Closure;

class CanChangeToDownloads
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
        if($request->route('portal') != 'download'){
            return $next($request);
        }else {
        $gamer = Gamer::where('ip_address', $request->ip())->first();
        $gamers = Gamer::all()->except($gamer->id);
        foreach ($gamers as $item) {
            if ($item->inDownloads == true) {
                abort(403, 'Lo siento ' . $gamer->nick . ', ya está '. $item->nick .' conectado al portal de descargas');
            }
        }
        return $next($request);
        }

    }
}
