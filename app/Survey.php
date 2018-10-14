<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    public function statements()
    {
        return $this->hasMany('App\Statement');
    }
}
