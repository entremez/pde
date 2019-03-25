<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderRegion extends Model
{
	public function region()
	{
		return $this->hasOne('App\City', 'id','city_id');
	}
}
