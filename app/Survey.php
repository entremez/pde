<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    protected $fillable = [
        'name', 'description', 'active'
    ];

    public function survey_questions()
    {
        return $this->hasMany('App\SurveyQuestion', 'survey_id');
    }
    public function survey_responses()
    {
        return $this->hasMany('App\SurveyResponse', 'survey_id');
    }
}
