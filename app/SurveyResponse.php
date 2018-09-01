<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyResponse extends Model
{
    public function survey()
    {
        return $this->belongsTo('App\Survey', 'survey_id');
    }

    public function responses()
    {
        return $this->hasMany('App\Response', 'survey_response_id');
    }

    public function getTotalAttribute()
    {
        $total = 0;
        foreach ($this->responses()->get() as  $value) {
            $total+=$value->total * $value->response_choice()->first()->weight;
        };
        return $total;
    }
}
