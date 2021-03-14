<?php

namespace App\Http\Controllers;

use App\Client;
use App\Log;
use App\Portal;
use App\Util\Logger;
use App\Util\Connection;
use Exception;
use Illuminate\Http\Request;
use Collective\Remote\RemoteFacade as SSH;

class MainController extends Controller
{
    public function getIpAddress(Request $request){
        return response()->json($request->ip());
    }

    public function ipAddressExists(Request $request) {

        $ip = $request->input('ip_address');
        if($ip) {
            $client = Client::where('ip_address', $ip)->first();
            if ($client) {
                return response()->json(['exists'=>true], 200);
            }else {
                return response()->json(['exists'=>false], 200);
            }
        }
        return response()->json($request->ip());
    }

    public function currentClientByIp( Request $request ) {

        $ip = $request->ip();
        $response = '';
        $client = Client::where('ip_address', $ip)->with(['client_type', 'portals'])->first();

        if(!$client) {
            return response()->json( 'Ip no registrada!', 404 );
        }

        try {
            $response = Connection::print($ip);
        } catch (Exception $th) {
            return response()->json('Intentelo de nuevo en unos segundos', 401);
        }

        $newResponse = str_replace('Flags: X - disabled, D - dynamic', '', $response);
        $newResponse = str_replace('#   LIST             ADDRESS                              CREATION-TIME       ', '', $newResponse);
        $newResponse = str_replace('\n', '', $newResponse);
        $newResponse = preg_replace('/\s\s+/', ' ', $newResponse);

        $arrResponse = explode(' ', $newResponse);

        if ($arrResponse[1] == 'X') { return response()->json('Usuario deshabilitado', 404); }

        $portal = Portal::where('address_list' ,$arrResponse[2])->first();

        if (!$portal){ return response()->json('Portal no encontrado', 404); }

        return response()->json(["client" => $client, "portal" => $portal], 200);

    }

    public function logs(Request $request){

        $ip = $request->ip();

        $logs = Log::orderBy('created_at', 'DESC')->get();

        return $logs->toJson(JSON_PRETTY_PRINT);

    }

    public function logout( Request $request, Client $client = null ) {

        $ip = $request->ip();
        $response = '';

        if($client) {
            $ip = $client->ip_address;
        }

        try {
            $response = Connection::print($ip);
        } catch (Exception $th) {
            return response()->json('Intentelo de nuevo en unos segundos', 401);
        }

        $newResponse = str_replace('Flags: X - disabled, D - dynamic', '', $response);
        $newResponse = str_replace('#   LIST             ADDRESS                              CREATION-TIME       ', '', $newResponse);
        $newResponse = str_replace('\n', '', $newResponse);
        $newResponse = preg_replace('/\s\s+/', ' ', $newResponse);
        $arrResponse = explode(' ', $newResponse);

        if ($arrResponse[1] == 'X') {
            return response()->json('Usuario deshabilitado', 404);
        }

        $portal = Portal::where('address_list' , $arrResponse[2])->first();

        if (!$portal){
            return response()->json('Portal no encontrado' . $newResponse, 404);
        }

        try {
            Connection::close($portal);
            Logger::log($request->ip , 'close' , $portal);
            return response()->json('Portal cerrado con éxito', 200);
        } catch (Exception $err) {
            return response()->json('Intentelo de nuevo en unos segundos', 401);
        }

    }

    public function change( Request $request, Portal $portal , Client $client = null ) {

        $ip = $request->ip();
        #$client = Client::where('ip_address', $ip)->first();

        if($client) {
            $ip = $client->ip_address;
        }

        if (!$portal) {
            return response()->json('Portal no encontrado', 404);
        }

        try {
            Connection::change( $ip , $portal);
            Logger::log($request->ip , 'change' , $portal);
            return response()->json('Portal cambiado con éxito.', 200);
        } catch (Exception $err) {
            return response()->json('Inténtelo en unos segundos.', 403);
        }

    }

    public function close( Request $request , Portal $portal ) {

        if(!$portal){
            return response()->json('Portal no encontrado', 404);
        }

        try {
            Connection::close($portal);
            Logger::log($request->ip , 'close' , $portal);
            return response()->json('Portal cerrado con éxito', 200);
        } catch (Exception $err) {
            return response()->json('Intentelo de nuevo en unos segundos', 401);
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

        $script = 'ip dhcp-client release [find interface="a2"]';
        $cooldown = 'ip firewall address-list add address=192.168.20.2 list=Cooldown timeout=00:00:15';

        try {
            SSH::run($script);
            SSH::run($cooldown);
        } catch (Exception $err) {
            return response()->json('Intentalo en unos segundos', 403);
        }

        return redirect()->route('portal')->with('success', 'Script ejecutado con éxito');
    }




}
