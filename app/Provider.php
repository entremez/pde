<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

use App\User;
use App\ProviderCounter;

class Provider extends Model
{
    protected $fillable = [
        'rut', 'dv_rut', 'name', 'address'
    ];

    public function cases()
    {
        return $this->hasMany('App\Instance');
    }

    public function getUrlAttribute()
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

    public function getAllServicesAttribute(){
        $services = '';
        foreach ($this->services as $service) {
            $services .= $service->service->name.', ';
        }
        return rtrim($services, ', ');
    }

    public function getAllServicesJsonAttribute(){
        $services = $this->services()->get();
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
}