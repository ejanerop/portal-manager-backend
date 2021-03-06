<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portal extends Model
{
    public function clients() {
        return $this->belongsToMany('App\Client');
    }
}
