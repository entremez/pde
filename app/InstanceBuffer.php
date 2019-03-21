<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Instance;

class InstanceBuffer extends Model
{
	public function identifier()
	{
		return $this->provider_id;
	}

    public function provider()
    {
        return $this->belongsTo('App\Provider', 'provider_id', 'id');
    }

    public function providerName()
    {
        return Instance::find($this->instance_id)->provider()->first()->name;
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

    public function getMyImageAttribute()
    {
        if($this->image!= null){
            if(substr($this->image, 0, 4) === "http")
                return trim($this->image);
                if(substr($this->image, 0, 4) === "/cla")
                    return $this->image;
                return asset('providers/case-images').'/'.$this->instance_id.'/'.$this->image;
        }
        return "/classifications/".$this->classification()->first()->default_image.".jpg";
    }

    public function getImageCompanyAttribute()
    {
            if(substr($this->company_logo, 0, 4) === "http")
                return $this->company_logo;
                return asset('providers/case-images').'/'.$this->instance_id.'/'.$this->company_logo;
    }


    public function classification()
    {
        return $this->belongsTo('App\Classification');
    }

    public function isBuffered()
    {
        return true;
    }

}
