<?php

namespace App\Http\Controllers;

use App\Client;
use App\Portal;
use App\Util\Connection;
use App\Util\Logger;
use Exception;
use Illuminate\Http\Request;

class ConnectionController extends Controller
{

    public function logout( Request $request, Client $client = null ) {

        $ip = $request->ip();
        $response = '';

        if($client) {
            $ip = $client->ip_address;
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

        if ($arrResponse[1] == 'X') {
            return response()->json('Usuario deshabilitado', 404);
        }

        $portal = Portal::where('address_list' , $arrResponse[1])->first();

        if (!$portal){
            return response()->json('Portal no encontrado' . $newResponse, 404);
        }

        try {
            Connection::close($portal);
            Logger::log($request->ip() , 'close' , $portal);
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
            Logger::log($request->ip() , 'change' , $portal);
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
            Logger::log($request->ip() , 'close' , $portal);
            return response()->json('Portal cerrado con éxito', 200);
        } catch (Exception $err) {
            return response()->json('Intentelo de nuevo en unos segundos', 401);
        }

    }


}
