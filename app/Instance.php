<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classification;
use App\InstanceCounter;

class Instance extends Model
{

    protected $fillable = [
        'name', 'company_name', 'description', 'long_description'
    ];

    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    public function images(){
        return $this->hasMany('App\InstanceImage');
    }

    public function services(){
        return $this->hasMany('App\InstanceService');
    }

    public function getImageAttribute()
    {
        if($this->images()->first()!= null){
            if(substr($this->images()->first()->image, 0, 4) === "http")
                return $this->images()->first()->image;
                return asset('providers/case-images/').'/'.$this->id.'/'.$this->images()->first()->image;
        }
        return "/classifications/".$this->classification()->first()->default_image.".jpg";
    }


    public function classification()
    {
        return $this->belongsTo('App\Classification');
    }

    public function counter($ip)
    {
        $counter = new InstanceCounter();
        $counter->instance_id = $this->id;
        $counter->ip = $ip;
        $counter->save();
    }
}
