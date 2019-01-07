<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstanceService extends Model
{
    public function instances(){
        return $this->hasMany('App\Instance', 'id', 'instance_id');
    }

    public function instance(){
        return $this->belongsTo('App\Instance', 'instance_id');
    }

    public function service(){
        return $this->belongsTo('App\Service', 'service_id');
    }
}
