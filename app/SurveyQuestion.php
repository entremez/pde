<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    protected $fillable = [
        'survey_id', 'question_id', 'order'
    ];

    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }

    public function survey()
    {
        return $this->belongsTo('App\Survey', 'survey_id');
    }
}
