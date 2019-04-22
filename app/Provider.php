<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\User;
use App\ProviderCounter;
use App\ProviderService;
use App\ProviderMember;
use App\ProviderRegion;
use App\ProviderComment;
use App\Instance;

class Provider extends Model
{
    protected $fillable = [
        'rut', 'dv_rut', 'name', 'address'
    ];

    public function regions()
    {
        return $this->hasMany('App\ProviderRegion');
    }

    public function getRegions()
    {
        $regions = collect();
        foreach ($this->regions as $region) {
            $regions->push($region->region()->first()->region);
        }
        return $regions;
    }

    public function cases()
    {
        return $this->hasMany('App\Instance');
    }

    public function team()
    {
        return $this->hasOne('App\ProviderMember');
    }

    public function city()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function commune()
    {
        return $this->hasOne('App\Commune', 'id', 'commune_id');
    }

    public function getImagenLogoAttribute()
    {
        if(substr($this->logo, 0, 4) === "http")
            return $this->logo;
        return asset('/providers/logos/'.$this->logo);
    }

    public function user()
    {
        return $this->hasOne('App\User', 'type_id');
    }

    public function getEmailAttribute()
    {
        $users = User::where('type_id',$this->id)->where('role_id', 2)->get()->first();
        return $users->email;
    }

    public function services()
    {
        return $this->hasMany('App\ProviderService', 'provider_id' , 'id');
    }

    public function instances()
    {
        return $this->hasMany('App\Instance', 'provider_id' , 'id');
    }

    public function instancesApproved()
    {
        return $this->instances->where('approved', true)->count();
    }

    public function getAllServicesAttribute(){
        $services = '';
        foreach ($this->services as $service) {
            $services .= $service->service->name.', ';
        }
        return rtrim($services, ', ');
    }

    public function getAllServicesJsonAttribute(){
        $services = $this->services()->orderBy('service_id')->get();
        $service = new Collection();
        foreach ($services as $s) {
            $service->push($s->service()->first());
        }
        return $service;
    }

    public function counter($ip){
        $counter = new ProviderCounter();
        $counter->provider_id = $this->id;
        $counter->ip = $ip;
        $counter->save();
        return $counter->id;
    }

    public function isMyService($service)
    {
        return !is_null(ProviderService::where('provider_id',$this->id)->where('service_id', $service)->first());
    }

    public function isMyRegion($city)
    {
        return !is_null(ProviderRegion::where('provider_id',$this->id)->where('city_id', $city)->first());
    }

    public function teamMember($index) // 0: tecnicos, 1: profesionales, 2: masters, 3: doctores
    {
        switch ($index) {
            case 0:
                return ProviderMember::where('provider_id', $this->id)->first()->tecnics;
                break;
            case 1:
                return ProviderMember::where('provider_id', $this->id)->first()->professionals;
                break;
            case 2:
                return ProviderMember::where('provider_id', $this->id)->first()->masters;
                break;
            case 3:
                return ProviderMember::where('provider_id', $this->id)->first()->doctors;
                break;
        }
        
    }

    public function isBuffered()
    {
        return $this->status;
    }

    public function address()
    {
        $regionAndCommune = $this->commune()->first()->commune == "En el extranjero" ? '': ', ' . $this->commune()->first()->commune. ', ' .$this->city()->first()->region. '.';
        return $this->address . $regionAndCommune ;
    }

    public function hasComments()
    {
        return ProviderComment::where('provider_id', $this->id)->where('status', '<>', 0)->get()->count() > 0;
    }

    public function comments()
    {
        return $this->hasComments() ? ProviderComment::where('provider_id', $this->id)->first()->message : '';
    }

    public function changesAfterComments()
    {
        return ProviderComment::where('provider_id', $this->id)->where('status', 2)->get()->count() > 0;
    }

    public function isMyCase(Instance $instance)
    {
        return $instance->provider_id == $this->id;
    }
}