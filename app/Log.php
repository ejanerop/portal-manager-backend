<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public function log_type(){
        return $this->belongsTo('App\LogType', 'log_type_id');
    }

    public function client(){
        return $this->belongsTo('App\Client', 'client_id');
    }

    public function portal(){
        return $this->belongsTo('App\Portal', 'portal_id');
    }
}
