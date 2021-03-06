<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function client_type(){
        return $this->belongsTo('App\ClientType', 'client_type_id');
    }

    public function portals() {
        return $this->belongsToMany('App\Portal');
    }
}
