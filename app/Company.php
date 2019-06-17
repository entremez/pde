<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CompanySurvey;
use App\Response;
use App\Option;
use App\Service;
use App\Level;

class Company extends Model
{
    protected $fillable = [
        'rut', 'dv_rut', 'name', 'address', 'user_id', 'classification_id', 'employees_id', 'gain_id', 'phone'
    ];

    public function survey_responses(){
        return $this->hasMany('App\SurveyResponse');
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
        return rand(30,60);
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



}
