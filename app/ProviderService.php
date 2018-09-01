<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProviderService extends Model
{
    public function service(){
        return $this->hasOne('App\Service', 'id', 'service_id');
    }
    public function provider(){
        return $this->hasOne('App\Provider', 'id', 'provider_id');
    }
}
