<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderComment extends Model
{
    public function admin()
    {
    	return $this->hasOne('App\Admin', 'id');
    }
}
