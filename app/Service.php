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

    public static function getNames($id)
    {
        return Service::find($id)->name;

        $out = "";
        foreach ($id as $key => $service) {
            $service = Service::find($service);
            if($key == 2){
                $out=substr($out, 0, -2);
                $out.=" o ".$service->name; 
            }else{
                $out.=$service->name.", "; 
            }
        }

        if(count($id) == 1)    
            return substr($out, 0, -2);
        if(count($id) == 2){
            $out = substr($out, 0, -2);
            return str_replace(',',' o',$out);
        }

        return $out;
    }
}
