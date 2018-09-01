<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'type', 'type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function instance(){
        switch (Auth::user()->type) {
            case 'Admin':
                $object = $this->hasOne('App\Admin', 'id', 'type_id');
                break;
            case 'Provider':
                $object = $this->hasOne('App\Provider', 'id', 'type_id');
                break;
            case 'Company':
                $object = $this->hasOne('App\Company', 'id', 'type_id');
                break;
        }
        return $object->get()->first();
    }

    public function getNameAttribute()
    {
        return $this->instance()->name;
    }

    public function getDashboardAttribute()
    {
        switch(auth()->user()->type){
                case "Admin":
                    return 'admin/dashboard';
                    break;
                case "Provider":
                    return 'provider/dashboard';
                    break;
                case "Company":
                    return 'company/dashboard';
                    break;
        }
    }

    public function getRouteNameAttribute()
    {
        switch(auth()->user()->type){
                case "Admin":
                    return 'admin.dashboard';
                    break;
                case "Provider":
                    return 'provider.dashboard';
                    break;
                case "Company":
                    return 'company.dashboard';
                    break;
        }
    }
}
