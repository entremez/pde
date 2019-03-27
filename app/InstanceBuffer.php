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

    public function instance()
    {
        return $this->hasOne('App\Instance' ,'id','instance_id');
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

    public function tags()
    {

        foreach ($this->services()->get() as $service) { //0 = services , 1 = sector , 2 = classification, 3 = employees, 4 = city , 5 = year 
            $aux['key'] = 0;
            $aux['name'] = $service->service()->first()->name;
            $aux['id'] = $service->service()->first()->id;
            $tags[] = $aux;
        }
        $aux['key'] = 1;
        $aux['name'] = $this->classification()->first()->sector()->first()->name;
        $aux['id'] = $this->classification()->first()->sector()->first()->id;
        $tags[] = $aux;
        $aux['key'] = 2;
        $aux['name'] = $this->classification()->first()->classification;
        $aux['id'] = $this->classification()->first()->id;
        $tags[] = $aux;
        $aux['key'] = 3;
        $aux['name'] = $this->employees()->first()->range;
        $aux['id'] = $this->employees()->first()->id;
        $tags[] = $aux;
        $aux['key'] = 4;
        $aux['name'] = $this->city()->first()->region;
        $aux['id'] = $this->city()->first()->id;
        $tags[] = $aux;
        $aux['key'] = 5;
        $aux['name'] = $this->year;
        $aux['id'] = $this->year;
        $tags[] = $aux;

        return $tags;
    }

}
