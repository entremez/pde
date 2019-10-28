<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecommendedService extends Model
{
    public function services()
    {
    	return $this->hasOne('App\Service', 'id', 'service_id');
    }

    public function options()
    {
    	return $this->hasOne('App\Option', 'id', 'option_id');
    }
}
