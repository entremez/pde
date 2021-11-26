<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImaxdEvaluation extends Model
{
    public function companies()
    {
        return $this->hasOne('App\ImaxdCompany', 'imaxd_evaluation_id');
    }
    public function cities()
    {
        return $this->hasMany('App\ImaxdCity', 'imaxd_evaluation_id');
    }
    public function activities()
    {
        return $this->hasMany('App\ImaxdActivity', 'imaxd_evaluation_id');
    }

    public function getInicioActividades()
    {
        return $this->companies()->first()->startup_statement;
    }

    public function getResSanitaria()
    {
        return $this->companies()->first()->sanitary_resolution;
    }

    public function getActivities()
    {
        if($this->activities()->count() > 0){
            return [];
        }
        return $this->activities()->get();
    }

    public function getRegion()
    {
        $out = [];
        foreach($this->cities()->get() as $city){
            $out[] = $city->region_id;
        }
        return  json_encode($out);
    }

    public function isElegible()
    {
        $options = ImaxdOptions::where('is_active', 1)->get()->last();
        $company = ImaxdCompany::where('imaxd_evaluation_id', $this->id)->first();
        $cities = $this->cities()->get();
        $activities = $this->activities()->get();
        
        $startup_statement = true;
        $sanitary_resolution = true;
        if($options->startup_satetment) $startup_statement = $company->startup_statement;
        if($options->sanitary_resolution) $sanitary_resolution = $company->sanitary_resolution;

        $requirements = json_decode($options->regions, true);
        
        if(isset($requirements['regions'])){
            $count = 0;
            foreach($requirements['regions'] as $region){
               foreach($cities as $city){
                    if($city->region_id == $region){
                        $count++;
                    }
               }
            }
            $out_region = $count == count($requirements['regions']);
        }
        if(isset($requirements['activities'])){
            $count = 0;
            foreach($requirements['activities'] as $r_activities){
               foreach($activities as $activity){
                    if($activity->activity_id == $r_activities){
                        $count++;
                    }
               }
            }
            $out_activities = $count == count($requirements['activities']);
        }
        return $startup_statement && $sanitary_resolution && $out_region && $out_activities;
    }

}
