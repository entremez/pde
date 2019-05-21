<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Provider;

class ProviderBuffer extends Model
{

    public function provider()
    {
        return Provider::find($this->provider_id);
    }

    public function regions()
    {
        return $this->hasMany('App\ProviderRegionBuffer', 'provider_id', 'provider_id');
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

    public function getEmailAttribute()
    {
        $users = User::where('type_id',$this->provider_id)->where('role_id', 2)->get()->first();
        return $users->email;
    }

    public function getContactEmailAttribute()
    {
        return $this->mail;
    }
	
    public function team()
    {
        return $this->hasOne('App\ProviderMemberBuffer', 'provider_id', 'provider_id');
    }


    public function teamMember($index) // 0: tecnicos, 1: profesionales, 2: masters, 3: doctores
    {
        switch ($index) {
            case 0:
                return ProviderMemberBuffer::where('provider_id', $this->provider_id)->first()->tecnics;
                break;
            case 1:
                return ProviderMemberBuffer::where('provider_id', $this->provider_id)->first()->professionals;
                break;
            case 2:
                return ProviderMemberBuffer::where('provider_id', $this->provider_id)->first()->masters;
                break;
            case 3:
                return ProviderMemberBuffer::where('provider_id', $this->provider_id)->first()->doctors;
                break;
        }
        
    }

    public function isMyService($service)
    {
        return !is_null(ProviderServiceBuffer::where('provider_id',$this->provider_id)->where('service_id', $service)->first());
    }

    public function isMyRegion($city)
    {
        return !is_null(ProviderRegionBuffer::where('provider_id',$this->provider_id)->where('city_id', $city)->first());
    }

    public function isBuffered()
    {
        return true;
    }

    public function address()
    {
        $regionAndCommune = $this->commune()->first()->commune == "En el extranjero" ? '': ', ' . $this->commune()->first()->commune. ', ' .$this->city()->first()->region. '.';
        return $this->address . $regionAndCommune ;
    }

    public function city()
    {
        return $this->hasOne('App\City', 'id', 'city_id');
    }

    public function services()
    {
        return $this->hasMany('App\ProviderServiceBuffer' , 'provider_id', 'provider_id');
    }


    public function getAllServicesJsonAttribute(){
        $services = $this->services()->orderBy('service_id')->get();
        $service = new Collection();
        foreach ($services as $s) {
            $service->push($s->service()->first());
        }
        return $service;
    }


    public function equalServices(Provider $provider){
        return $provider->all_services_json->diff($this->all_services_json)->count() + $this->all_services_json->diff($provider->all_services_json)->count() == 0;
    }

    public function servicesMaintained(Provider $provider)
    {
        return $provider->all_services_json->intersect($this->all_services_json);
    }

    public function servicesRemoved(Provider $provider)
    {
        return $provider->all_services_json->diff($this->all_services_json);
    }

    public function servicesAdded(Provider $provider)
    {
        return $this->all_services_json->diff($provider->all_services_json);
    }

    public function equalRegions(Provider $provider){

        return $provider->getRegions()->diff($this->getRegions())->count() + $this->getRegions()->diff($provider->getRegions())->count() == 0;
    }

    public function regionMaintained(Provider $provider)
    {
        return $provider->getRegions()->intersect($this->getRegions());
    }

    public function regionRemoved(Provider $provider)
    {
        return $provider->getRegions()->diff($this->getRegions());
    }

    public function regionAdded(Provider $provider)
    {
        return $this->getRegions()->diff($provider->getRegions());
    }

    public function getRegions()
    {
        $regions = collect();
        foreach ($this->regions as $region) {
            $regions->push($region->region()->first()->region);
        }
        return $regions;
    }

    public function hasComments()
    {
        return ProviderComment::where('provider_id', $this->provider_id)->get()->count() > 0;
    }

    public function comments()
    {
        return $this->hasComments() ? ProviderComment::where('provider_id', $this->provider_id)->first()->message : '';
    }

    public function changesAfterComments()
    {
        return ProviderComment::where('provider_id', $this->provider_id)->where('status', 2)->get()->count() > 0;
    }

}
