<?php

namespace App\Util;

use App\Portal;
use Exception;
use Collective\Remote\RemoteFacade as SSH;

class Connection
{

    public static function change( $ip , Portal $portal ) {

        $script = 'ip firewall address-list set [find where address="' . $ip .'"] list="' . $portal->address_list . '"';

        try {
            SSH::run($script);
        } catch (Exception $err) {
            throw $err;
        }

    }

    public static function close( Portal $portal ) {

        $script = 'ip dhcp-client release [find interface=' . $portal->dhcp_client . ']';

        try {
            SSH::run($script);
        } catch (Exception $err) {
            throw $err;
        }

    }

    public static function print( $arg , $ip ) {

        $command = 'ip firewall address-list print where '. $arg . '="' . $ip . '"';
        $response = '';

        try {
            SSH::run($command, function($line) use(&$response) {
                $response .= $line;
            });
            return $response;
        } catch (Exception $th) {
            throw $th;
        }

    }





}
