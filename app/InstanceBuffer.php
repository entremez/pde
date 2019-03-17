<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanceBuffer extends Model
{
	public function identifier()
	{
		return $this->provider_id;
	}

public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    public function services(){
        return $this->hasMany('App\InstanceServiceBuffer' ,'instance_id','instance_id');
    }

    public function city(){
        return $this->belongsTo('App\City');
    }

    public function employees(){
        return $this->belongsTo('App\Employees','employees_range');
    }

    public function getImageAttribute()
    {
        if($this->images!= null){
            if(substr($this->image, 0, 4) === "http")
                return trim($this->image);
                return asset('providers/case-images/').'/'.$this->id.'/'.$this->image;
        }
        return "/classifications/".$this->classification()->first()->default_image.".jpg";
    }

    public function getImageCompanyAttribute()
    {
            if(substr($this->company_logo, 0, 4) === "http")
                return $this->company_logo;
                return asset('providers/case-images/').'/'.$this->id.'/'.$this->company_logo;
    }


    public function classification()
    {
        return $this->belongsTo('App\Classification');
    }

}
