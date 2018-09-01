<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'question', 'question_type_id', 'survey_id'
    ];

    public function question_type()
    {
        return $this->belongsTo('App\QuestionType', 'question_type_id');
    }

    public function survey()
    {
        return $this->belongsTo('App\Survey', 'survey_id');
    }

    public function response_choices()
    {
        return $this->hasMany('App\ResponseChoice', 'question_id');
    }

    public function survey_questions()
    {
        return $this->hasMany('App\SurveyQuestion');
    }
}
