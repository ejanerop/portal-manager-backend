<?php

namespace App\Http\Controllers;

use App\Gamer;
use App\Log;
use App\Util\Logger;
use Illuminate\Http\Request;
use SSH;
use App\Util\Portals;
use ErrorException;

class GamerController extends Controller
{
//----------------------------------------usuarios normales----------------------------------
    public function logout(Request $request){

        $ip = $request->ip();
        //$gamer = Gamer::where('ip_address', $ip)->first();
        $interface = Portals::getInterface($ip);
        $script = 'ip dhcp-client release [find interface=' . $interface . ']';
        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';
        try {
            SSH::run($script);
            SSH::run($cooldown);
            return redirect()->route('portal')->with('success', 'Portal cerrado con éxito');
        } catch (ErrorException $err) {
            return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
        }



    }
//----------------------------------------Gamers---------------------------------------------
    public function logs(Request $request){

        $ip = $request->ip();

        $logs = Log::orderBy('created_at', 'DESC')->get();

        return view('logs', ['logs' => $logs]);

    }

    public function closeSession(Request $request, $portal){

        $type ='';
        $ip = $request->ip();
        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:10';

        if($portal == 'games'){

            $type = 'closeGames';
            $script = 'ip dhcp-client release [find interface=a4]';


            try {
                SSH::run($script);
                SSH::run($cooldown);
                Logger::log($ip, $type);
            } catch (ErrorException $err) {
                return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
            }

        }elseif ($portal == 'download') {

            $type = 'closedownload';
            $script = 'ip dhcp-client release [find interface=a5]';

            try {
                SSH::run($script);
                SSH::run($cooldown);
                Logger::log($ip, $type);
            } catch (ErrorException $err) {
                return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
            }

        }

        return redirect()->route('portal')->with('success', 'Portal cerrado con éxito');

    }

    public function changePortal(Request $request, $portal){

        $ip = $request->ip();
        $gamer = Gamer::where('ip_address', $request->ip())->first();
        $gamers = Gamer::all();
        $type ='';
        if(($portal == 'games') || ($portal == 'download')){

            if ($portal == 'games') {
                $portal = '4Games';
                $type ='changeGames';
            }else {
                $portal = '5Downloads';
                $type ='changeDownload';
            }


            $script = 'ip firewall address-list set [find where address="' . $ip .'"] list="' . $portal . '"';
            $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';

            if (($type =='changeGames') ) {
                $gamer->inDownloads = false;
                $gamer->save();
            }
            if ($type =='changeDownload') {
                foreach ($gamers as $item) {
                    $item->inDownloads = false;
                    $item->save();
                }
                $gamer->inDownloads = true;
                $gamer->save();
            }

            try {
                SSH::run($script);
                SSH::run($cooldown);
                Logger::log($ip, $type);
                return redirect()->route('portal')->with('success', 'Portal cambiado con éxito');

            } catch (ErrorException $err) {
                return redirect()->route('portal')->with('error', 'Inténtelo de nuevo en unos segundos');
            }
        }


    }
}
