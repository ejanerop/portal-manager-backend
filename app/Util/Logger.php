<?php

namespace App\Util;

use App\Client;
use App\Log;
use App\LogType;
use App\Portal;

class Logger
{
	public static function log($ip, $type, Portal $portal) {
        $log = new Log();
        $logType = LogType::where('type', $type)->first();
        $client = Client::where('ip_address', $ip)->first();
        $log->log_type()->associate($logType);
        $log->client()->associate($client);
        $log->portal()->associate($portal);
		$log->save();
	}
}
