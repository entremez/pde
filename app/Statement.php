<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Option;
use App\Response;

class Statement extends Model
{
    public function statement_type()
    {
        return $this->hasOne('App\StatementType', 'id', 'statement_type_id');
    }
    public function options()
    {
        return $this->hasMany('App\Option');
    }

    public function last()
    {
    	return $this->options->last()->id;
    }

    public function first()
    {
    	return $this->options->first()->id;
    }

    public function graph()
    {
        foreach ($this->options as $option) {  
            $yes["name"] = $option->option;
            $yes["y"] =  Response::where('option_id', $option->id)->where('company_survey_id','!=', 6)->where('company_survey_id','!=', 7)->where('company_survey_id','!=', 11)->get()->count();
            $out[] = $yes;
        }
        return json_encode($out);
    }

}
