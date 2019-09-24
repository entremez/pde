<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public function linkImage()
    {
    	return asset('/images/links/'.$this->image);
    }
}
