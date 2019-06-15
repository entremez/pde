<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanySurvey extends Model
{
    public function area()
    {
    	return $this->hasOne('App\Area' ,'id','area_id');
    }
}
