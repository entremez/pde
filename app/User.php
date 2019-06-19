<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'role_id', 'type_id','remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
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

    public function type()
    {
        switch ($this->role_id) {
            case 3:
                return "Empresa";
                break;
            case 1:
                return "Admin";
                break;
            case 2:
                return "Proveedor";
                break;
        }  
    }

    public function sendPasswordResetNotification($token)
    {
        Mail::send(new ResetPassword($this->email, $token));
    }   
}
