<?php

namespace App\Http\Controllers;

use App\Client;
use App\Portal;
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
        $client = Client::where('ip_address', $ip)->with(['client_type', 'portals' , 'permissions'])->first();

        if(!$client) {
            return response()->json( 'Ip no registrada!', 404 );
        }

        try {
            $response = Connection::print('address' , $ip);
        } catch (Exception $th) {
            return response()->json('Intentelo de nuevo en unos segundos', 401);
        }

        $newResponse = str_replace('Flags: X - disabled, D - dynamic', '', $response);
        $newResponse = str_replace('#   LIST             ADDRESS                              CREATION-TIME       ', '', $newResponse);
        $newResponse = str_replace('\n', '', $newResponse);
        $newResponse = str_replace(';', '', $newResponse);
        $newResponse = str_replace('-', '', $newResponse);
        $newResponse = preg_replace('/\s\s+/', ' ', $newResponse);
        $newResponse = trim($newResponse);

        $arrResponse = explode(' ', $newResponse);

        if ($arrResponse[1] == 'X') { return response()->json('Usuario deshabilitado', 404); }

        $portal = Portal::where('address_list' ,$arrResponse[1])->first();

        if (!$portal){ return response()->json('Portal no encontrado', 404); }

        return response()->json(["client" => $client, "portal" => $portal], 200);

    }

    public function clientsInPortal( Request $request , Portal $portal ) {

        $response = '';
        $clients = [];

        if (!$portal) {
            return response()->json('Portal no encontrado', 404 );
        }

        try {
            $response = Connection::print('list' , $portal->address_list);
        } catch (Exception $th) {
            return response()->json('Intentelo de nuevo en unos segundos', 401 );
        }

        $newResponse = str_replace('Flags: X - disabled, D - dynamic', '', $response);
        $newResponse = str_replace('#   LIST             ADDRESS                              CREATION-TIME       ', '', $newResponse);
        $newResponse = str_replace('\n', '', $newResponse);
        $newResponse = str_replace(';', '', $newResponse);
        $newResponse = str_replace('-', '', $newResponse);
        $newResponse = preg_replace('/\s\s+/', ' ', $newResponse);
        $newResponse = trim($newResponse);

        $arrResponse = explode(' ', $newResponse);

        $count = 0;

        foreach ($arrResponse as $item) {
            if (strpos($item , '192.168.20.') !== false ){
                $client = Client::where('ip_address' , $item)->first();
                if ($client) {
                    array_push( $clients , $client);
                }
            }
        }

        return response()->json( $clients, 200 );


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

        try {
            SSH::run($script);
        } catch (Exception $err) {
            return response()->json('Intentalo en unos segundos', 403);
        }

        return redirect()->route('portal')->with('success', 'Script ejecutado con éxito');
    }




}
