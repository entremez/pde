<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderBuffer extends Model
{
    public function getImagenLogoAttribute()
    {
        if(substr($this->logo, 0, 4) === "http")
            return $this->logo;
        return asset('/providers/logos/'.$this->logo);
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
        return !is_null(ProviderService::where('provider_id',$this->provider_id)->where('service_id', $service)->first());
    }

    public function isMyRegion($city)
    {
        return !is_null(ProviderRegion::where('provider_id',$this->provider_id)->where('city_id', $city)->first());
    }

}
