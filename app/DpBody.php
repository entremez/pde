<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DpBody extends Model
{
	public function sentence()
	{
		 return $this->hasOne('App\DpSentence','id', 'sentence_id');
	}
}
