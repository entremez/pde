<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanceImage extends Model
{
    public function case()
    {
        return $this->belongsTo('App\Instance');
    }

    public function getUrlAttribute()
    {
        if(substr($this->image, 0, 4) === "http")
            return $this->image;
        return '/providers/case-images/'.$this->instance_id.'/'.$this->image;
    }
}
