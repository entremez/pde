<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Classification;
use App\InstanceCounter;
use App\InstanceBuffer;
use Illuminate\Support\Collection;
use App\Provider;

class Instance extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'company_name', 'description', 'long_description'
    ];  

    public function identifier()
    {
        return $this->id;
    }

    public function provider()
    {
        return $this->belongsTo('App\Provider');
    }

    public function images(){
        return $this->hasMany('App\InstanceImage');
    }

    public function businessType(){
        return $this->hasOne('App\BusinessType', 'id', 'business_type');
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

    public function getMyImageAttribute()
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

        foreach ($this->services()->get() as $service) { //0 = services , 1 = sector , 2 = classification, 3 = employees, 4 = city , 5 = year , 6 = business type
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
        $aux['key'] = 6;
        $aux['name'] = $this->businessType()->first()->type;
        $aux['id'] = $this->business_type;
        $tags[] = $aux;

        return $tags;
    }

    public function related($max)
    {
        $instances = collect();
        foreach (Instance::where('approved', true)->where('id', '!=', $this->id)->get() as $instance) {
            if($instance->classification()->first()->sector()->first() == $this->classification()->first()->sector()->first()){
                $instances->push($instance);   
            }
        }
        if($instances->count() >= $max)
            return $instances;
        foreach (Instance::where('approved', true)->where('id', '!=', $this->id)->get() as $instance) {
            if($instance->employees_range == $this->employees_range){
                $instances->push($instance);   
            }
        }
        if($instances->count() >= $max)
            return $instances->unique();
        foreach (Instance::where('approved', true)->where('id', '!=', $this->id)->get() as $instance) {
            if($instance->city_id == $this->city_id){
                $instances->push($instance);   
            }
        }
        if($instances->count() >= $max)
            return $instances->unique();
        return $instances->unique();
    }

    public function isCategory($category)
    {
        $services = $this->services()->get();
        foreach ($services as $service) 
            if($service->service()->first()->category_id == $category)
                return true;
        return false;
    }

    public function isService($service)
    {
        $services = $this->services()->get();
        foreach ($services as $serviceid) 
            if($serviceid->service()->first()->id == $service)
                return true;
        return false;
    }

    public function isBuffered()
    {
        return $this->status;
    }

    public function getCornerBufferedAttribute()
    {
        $classification_id = InstanceBuffer::where('instance_id', $this->id)->first()->classification_id;
        return Classification::find($classification_id)->classification;
    }


    public function getMyImageBufferedAttribute()
    {
        return InstanceBuffer::where('instance_id', $this->id)->first()->my_image;
    }

    public function getQuantityBufferedAttribute()
    {
        return InstanceBuffer::where('instance_id', $this->id)->first()->quantity;
    }

    public function getSentenceBufferedAttribute()
    {
        return InstanceBuffer::where('instance_id', $this->id)->first()->sentence;
    }

    public function getUnitBufferedAttribute()
    {
        return InstanceBuffer::where('instance_id', $this->id)->first()->unit;
    }

    public function emailProvider()
    {
        return User::where('role_id', 2)->where('type_id', Provider::find($this->provider_id)->id)->first()->email;
    }

    public function nameProvider()
    {
        return Provider::find($this->provider_id)->first()->name;
    }


    public function hasComments()
    {
        return ProviderComment::where('instance_id', $this->id)->where('type', 2)->where('status', '<>', 0)->get()->count() > 0;
    }

    public function comments()
    {
        return $this->hasComments() ? ProviderComment::where('instance_id', $this->id)->where('type', 2)->first()->message : '';
    }

    public function changesAfterComments()
    {
        return ProviderComment::where('instance_id', $this->id)->where('type', 2)->where('status', 2)->get()->count() > 0;
    }

}
