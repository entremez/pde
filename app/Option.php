<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Response;

class Option extends Model
{
    public function statement()
    {
    	return $this->belongsTo('App\Statement');
    }

    public function responses()
    {
        $uno = 0;
        $dos = 0;
        $tres = 0;
        $cuatro = 0;
        $cinco = 0;

        foreach(Response::where('option_id', $this->id)->where('company_survey_id','!=', 6)->where('company_survey_id','!=', 7)->where('company_survey_id','!=', 11)->get() as $response){
            switch ($response->value){
                case 1:
                    $uno++;
                    break;
                case 2:
                    $dos++;
                    break;
                case 3:
                    $tres++;
                    break;
                case 4:
                    $cuatro++;
                    break;
                case 5:
                    $cinco++;
                    break;
            }
        }

        if($this->statement->id == 8)
        	return json_encode([$uno,$dos,$tres, $cuatro]);
        return json_encode([$uno,$dos,$tres, $cuatro, $cinco]);

    }

    public static function getResponse($response)
    {
        $out = collect();
        foreach (Option::where('statement_id', 8)->get() as $option) {
            $value = Response::where('option_id', $option->id)->where('value', $response)->where('company_survey_id','!=', 6)->where('company_survey_id','!=', 7)->where('company_survey_id','!=', 11)->get()->count();
            $out->push($value);
        }
        return json_encode($out);
    }
}
