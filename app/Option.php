<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function statement()
    {
    	return $this->belongsTo('App\Statement');
    }
}
