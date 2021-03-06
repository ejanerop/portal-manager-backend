<?php

namespace App\Http\Controllers;

use App\Gamer;
use App\Log;
use App\Util\Logger;
use SSH;
use Illuminate\Http\Request;
use App\Util\Portals;
use ErrorException;

class SpecialController extends Controller
{
    

    public function closeSpecial(Request $request, $portal){

        $type ='';
        $ip = $request->ip();

        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';

        if($portal == 'national'){

            if (!Portals::isSpecialUser($ip)) {
                return redirect()->route('portal')->with('error', 'Portal no autorizado.');
            }

            $script = 'ip dhcp-client release [find interface="a2"]';

         try {
                SSH::run($script);
                SSH::run($cooldown);
            } catch (ErrorException $err) {
                return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
            }

        }elseif ($portal == 'international') {

            if (!Portals::isSpecialUser($ip)) {
                return redirect()->route('portal')->with('error', 'Portal no autorizado.');
            }

            $script = 'ip dhcp-client release [find interface="a6"]';

            try {
                SSH::run($script);
                SSH::run($cooldown);
            } catch (ErrorException $err) {
                return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
            }




        }elseif($portal == 'portal1'){

            if (!Portals::isSpecialUser2($ip)) {
                return redirect()->route('portal')->with('error', 'Portal no autorizado.');
            }

            $script = 'ip dhcp-client release [find interface=a8]';

            try {
                SSH::run($script);
                SSH::run($cooldown);
            } catch (ErrorException $err) {
                return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
            }

        }


        return redirect()->route('portal')->with('success', 'Portal cerrado con éxito');
    }

    public function changeSpecial(Request $request, $portal){

        $ip = $request->ip();
        $type ='';
        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';

        if((($portal == 'national') || ($portal == 'international')) && (Portals::isSpecialUser($ip))){

            if($portal == 'national') {
                $portal = '#!Nacional2';
            }elseif ($portal == 'international') {
                $portal = 'portal6';
            }
        }

        if((($portal == 'portal1') || ($portal == 'portal2')) && (Portals::isSpecialUser2($ip))){

            if($portal == 'portal1') {
                $portal = 'portal8';
            }elseif ($portal == 'portal2') {
                $portal = '2Games';
            }
        }        

        $script = 'ip firewall address-list set [find where address="' . $ip .'"] list="' . $portal . '"';

        try {
            SSH::run($script);
            SSH::run($cooldown);
        } catch (ErrorException $err) {
            return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
        }

        return redirect()->route('portal')->with('success', 'Portal cambiado con éxito');


    }    

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
                return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
            }

            return redirect()->route('portal')->with('success', 'Script habiblitado con éxito');
        }else {
           
            $scriptDisable = 'system script job remove [find script=#!8AutologuinTimeBucleGames]';
            try {
                SSH::run($scriptDisable);
                SSH::run($cooldown);
            } catch (ErrorException $err) {
                return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
            }

            return redirect()->route('portal')->with('success', 'Script deshabiblitado con éxito');
        }

    }

    public function closeVerySpecial(Request $request, $portal){

        $type ='';
        $ip = $request->ip();

        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';

        if ($portal == '1'){

            if($ip == '192.168.20.86'){                
                return redirect()->route('portal')->with('error', 'Portal no autorizado');
            }

            $script = 'ip dhcp-client release [find interface="a12"]';

        }elseif ($portal == '2'){

            if($ip == '192.168.20.86'){                
                return redirect()->route('portal')->with('error', 'Portal no autorizado');
            }

            $script = 'ip dhcp-client release [find interface="a15"]';

        }elseif ($portal == '3'){

            $script = 'ip dhcp-client release [find interface="a16"]';

        }elseif ($portal == '4'){

            if($ip == '192.168.20.86'){                
                return redirect()->route('portal')->with('error', 'Portal no autorizado');
            }
            
            $script = 'ip dhcp-client release [find interface="a17"]';

        }        

        try {
            SSH::run($script);
            SSH::run($cooldown);
        } catch (ErrorException $err) {
            return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
        }


        return redirect()->route('portal')->with('success', 'Portal cerrado con éxito');
    }

    public function changeAvenger(Request $request){

        $ip = $request->ip();
        $type ='';
        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';

        $script = 'ip firewall address-list set [find where address="192.168.20.14"] list="portal27"';
        try {
            SSH::run($script);
            SSH::run($cooldown);
        } catch (ErrorException $err) {
            return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
        }

        return redirect()->route('portal')->with('success', 'Portal cambiado con éxito');

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
            return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
        }

        return redirect()->route('portal')->with('success', 'Script ejecutado con éxito');
    }

    public function changeEric(Request $request, $portal){
        $ip = $request->ip();
        $type ='';
        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';

        if((($portal == 'gamer') || ($portal == 'free')) && (Portals::isEric($ip))){

            if($portal == 'gamer') {
                $portal = '4Games';
            }elseif ($portal == 'free') {
                $portal = 'portal10';
            }
        }

        $script = 'ip firewall address-list set [find where address="' . $ip .'"] list="' . $portal . '"';

        try {
            SSH::run($script);
            SSH::run($cooldown);
        } catch (ErrorException $err) {
            return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
        }

        return redirect()->route('portal')->with('success', 'Portal cambiado con éxito');
    }

    public function closeEric(Request $request){
        $type ='';
        $ip = $request->ip();

        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';
        $script = 'ip dhcp-client release [find interface="a10"]';

        try {
            SSH::run($script);
            SSH::run($cooldown);
        } catch (ErrorException $err) {
            return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
        }

        return redirect()->route('portal')->with('success', 'Portal cerrado con éxito');
    }
    
    public function changeFlasho(Request $request){

        $ip = $request->ip();
        $type ='';
        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';

        $script = 'ip firewall address-list set [find where address="192.168.20.18"] list="portal9"';
        try {
            SSH::run($script);
            SSH::run($cooldown);
        } catch (ErrorException $err) {
            return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
        }

        return redirect()->route('portal')->with('success', 'Portal cambiado con éxito');

    }

    public function closeFlasho(Request $request){

        $ip = $request->ip();
        $type ='';

        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';
        $script = 'ip dhcp-client release [find interface="a9"]';
        
        try {
            SSH::run($script);
            SSH::run($cooldown);
        } catch (ErrorException $err) {
            return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
        }

        return redirect()->route('portal')->with('success', 'Portal cerrado con éxito');

    }
}
