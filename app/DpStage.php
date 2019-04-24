<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DpStage extends Model
{
	public function titles()
	{
		 return $this->hasMany('App\DpTitle','stage_id');
	}
}
