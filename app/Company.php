<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Classification;
use App\Employees;
use App\Gain;
use App\CompanySurvey;
use App\Response;
use App\Option;
use App\Service;
use App\Level;
use Freshwork\ChileanBundle\Rut;
use App\Sector;

class Company extends Model
{
    protected $fillable = [
        'rut', 'dv_rut', 'name', 'address', 'user_id', 'classification_id', 'employees_id', 'gain_id', 'phone'
    ];

    public function classification()
    {
        return $this->hasOne('App\Classification' ,'id', 'classification_id');
    }

    public function employees()
    {
        return $this->hasOne('App\Employees' ,'id', 'employees_id');
    }

    public function gain()
    {
        return $this->hasOne('App\Gain' ,'id', 'gain_id');
    }

    public function survey_responses(){
        return $this->hasMany('App\SurveyResponse');
    }

    public function getEmailAttribute()
    {
        $users = User::where('type_id',$this->id)->where('role_id', 3)->get()->first();
        return $users != null ? $users->email:'error';
    }

    public function getRut()
    {
        return Rut::parse($this->rut.$this->dv_rut)->format();
    }

    public function hasTravels()
    {
    	return CompanySurvey::where('company_id', $this->id)->get()->count() > 0;
    }

    public function lastTravel(){
        return CompanySurvey::where('company_id', $this->id)->orderBy('created_at', 'desc')->first();
    }   

    public function lastTravelDate(){
        return CompanySurvey::where('company_id', $this->id)->orderBy('created_at', 'desc')->first()->getDate();
    }   

    public function sameLevel()
    {
        $level = $this->lastTravel()->level_id;
        $count_level = CompanySurvey::where('level_id', $level)->get()->count();
        $total_count = CompanySurvey::all()->count();
        return round(100*($count_level/ $total_count) , 0);
    }

    public function sameLevelWithLevel($level)
    {
        $count_level = CompanySurvey::where('level_id', $level)->get()->count();
        $total_count = CompanySurvey::all()->count();
        return round(100*($count_level/ $total_count) , 0);
    }

    public function stairs()
    {
        $lasttravel = $this->lastTravel();;
        $out = [];
        $out[0] = $lasttravel->level->phrase;
        $out[1] = $lasttravel->level->image;
        return $out;
    
    }

    public function recomendation()
    {
        $lastTravel = $this->lastTravel();
        $out = [];
        $out[0] = $lastTravel->area->name;
        $out[1] = $lastTravel->service_id;
        $out[2] = asset('images/areas/'.$lastTravel->area->image);
        return $out;
    }

    public function getProviders($serviceR)
    {
        $providers = Provider::where('approved', true)->get();

        $out = collect();
        $count = 0;
        foreach ($providers as $provider) {
            foreach($provider->services as $service){
                if($service->service_id == $serviceR){
                    $out->push($provider);
                    $count++;  
                    break;
                }                 
            }
            if($count == 8)
                break;
        }
        return $out;
    }

    public function sector()
    {
        $primario = 0;
        $secundario = 0;
        $terciario = 0;
        foreach (Company::where('id','!=', 1)->where('id','!=', 2)->where('id','!=', 9)->get() as $company) {
            switch (($company->classification->sector_id)) {
                case 1:
                    $primario++;
                    break;
                case 2:
                    $secundario++;
                    break;
                case 3:
                    $terciario++;
                    break;
            }
        }
        $counts = [$primario, $secundario, $terciario];

        foreach (Sector::all() as $key => $sector) {
            $yes["name"] = $sector->name;
            $yes["y"] =  $counts[$key];
            $out[] = $yes;
        }

        return json_encode($out);
    }



}
