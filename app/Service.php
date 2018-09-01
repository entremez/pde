<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function instances()
    {
        return $this->hasMany('App\InstanceService');
    }

    public function providers(){
        return $this->hasMany('App\ProviderService','service_id','id');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }
}
