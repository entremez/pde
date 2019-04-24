<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DpTitle extends Model
{
	public function bodies()
	{
		 return $this->hasMany('App\DpBody','title_id');
	}

	public function image()
	{
		return asset('/images/instruments/'.$this->logo);
	}
}
