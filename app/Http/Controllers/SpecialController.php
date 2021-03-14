<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ErrorException;
use Collective\Remote\RemoteFacade as SSH;

class SpecialController extends Controller
{


    public function toggleScript(Request $request, $active = false){

        $ip = $request->ip();
        $type ='';
        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';

        if($active){

            $scriptEnable = 'system scheduler enable [find name=#!1EnableScriptManualVengador];:delay "7";system scheduler disable [find name=#!1EnableScriptManualVengador]';
            try {
                SSH::run($scriptEnable);
                SSH::run($cooldown);
            } catch (ErrorException $err) {
                return response()->json('Intentalo en unos segundos', 401);
            }

            return redirect()->route('portal')->with('success', 'Script habiblitado con éxito');
        }else {

            $scriptDisable = 'system script job remove [find script=#!8AutologuinTimeBucleGames]';
            try {
                SSH::run($scriptDisable);
                SSH::run($cooldown);
            } catch (ErrorException $err) {
                return response()->json('Intentalo en unos segundos', 401);
            }

            return redirect()->route('portal')->with('success', 'Script deshabiblitado con éxito');
        }

    }

    public function enableVpnScript(){

        system("cmd /c C:\Users\webnew\Desktop\startservice.bat");

        return redirect()->route('portal')->with('success', 'Script ejecutado con éxito');
    }

    public function disableVpnScript(Request $request){

        system("cmd /c C:\Users\webnew\Desktop\stopservice.bat");

        $ip = $request->ip();
        $type ='';

        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';
        $script = 'ip dhcp-client release [find interface="a2"]';

        try {
            SSH::run($script);
            SSH::run($cooldown);
        } catch (ErrorException $err) {
            return response()->json('Intentalo en unos segundos', 401);
        }

        return redirect()->route('portal')->with('success', 'Script ejecutado con éxito');
    }


}
