<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function survey_response()
    {
        return $this->belongsTo('App\SurveyResponse');
    }

    public function response_choice()
    {
        return $this->belongsTo('App\ResponseChoice');
    }


}
