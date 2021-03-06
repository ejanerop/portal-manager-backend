<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function clients() {
        return $this->belongsToMany('App\Client');
    }
}
