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
        'email', 'password', 'role_id', 'type_id'
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
        switch (Auth::user()->role_id) {
            case 1:
                $object = $this->hasOne('App\Admin', 'id', 'type_id');
                break;
            case 2:
                $object = $this->hasOne('App\Provider', 'id', 'type_id');
                break;
            case 3:
                $object = $this->hasOne('App\Company', 'id', 'type_id');
                break;
        }
        return $object->get()->first();
    }

    public function getDashboardAttribute()
    {
        switch(auth()->user()->role_id){
                case 1:
                    return 'admin/dashboard';
                    break;
                case 2:
                    return 'providers/dashboard';
                    break;
                case 3:
                    return 'company/dashboard';
                    break;
        }
    }

    public function getRouteNameAttribute()
    {
        switch(auth()->user()->role_id){
                case 1:
                    return 'admin.dashboard';
                    break;
                case 2:
                    return 'providers.dashboard';
                    break;
                case 3:
                    return 'company.dashboard';
                    break;
        }
    }

    public function evaluateText()
    {
        switch ($this->role_id) {
            case 3:
                return "Evalúa a tu empresa";
                break;
            case 1:
                return "Admin, regístrate como empresa para evaluarte";
                break;
            case 2:
                return "Regístrate como empresa para evaluarte";
                break;
        }
    }

    public function needTravel()
    {
        return $this->role_id == 3;
    }
}
