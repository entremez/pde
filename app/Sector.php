<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public function classifications(){
        return $this->hasMany('App\Classification');
    }
}
