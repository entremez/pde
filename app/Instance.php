<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Classification;
use App\InstanceCounter;
use Illuminate\Support\Collection;

class Instance extends Model
{
    use SoftDeletes;

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

    public function city(){
        return $this->belongsTo('App\City');
    }

    public function employees(){
        return $this->belongsTo('App\Employees','employees_range');
    }

    public function getImageAttribute()
    {
        if($this->images()->first()!= null){
            if(substr($this->images()->first()->image, 0, 4) === "http")
                return trim($this->images()->first()->image);
                return asset('providers/case-images/').'/'.$this->id.'/'.$this->images()->first()->image;
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

    public function counter($ip)
    {
        $counter = new InstanceCounter();
        $counter->instance_id = $this->id;
        $counter->ip = $ip;
        $counter->save();
    }

    public function tags()
    {
        $tags = collect();
        foreach ($this->services()->get() as $service) {
            $tags->push($service->service()->first()->name);
        }
        $tags->push($this->classification()->first()->sector()->first()->name);
        $tags->push($this->classification()->first()->classification);
        $tags->push($this->employees()->first()->range);
        $tags->push($this->city()->first()->region);
        $tags->push($this->year);

        return $tags;
    }

}
