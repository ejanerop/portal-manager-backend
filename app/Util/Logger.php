<?php

namespace App\Util;

use App\Gamer;
use App\Log;
use App\LogType;

class Logger
{
	public static function log($ip, $type) {
        $log = new Log();
        $logType = LogType::where('slug', $type)->first();
        $log->log_type()->associate($logType);
        $log->gamer()->associate(Gamer::where('ip_address', $ip)->first());
		$log->save();
	}
}
