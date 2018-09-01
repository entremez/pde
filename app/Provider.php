<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

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
        return '/providers/logos/'.$this->logo;
    }

    public function user()
    {
        return $this->hasOne('App\User', 'type_id');
    }

    public function getEmailAttribute()
    {
        $users = User::where('type_id',$this->id)->where('type', 'Provider')->get()->first();
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
}