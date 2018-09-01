<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseChoice extends Model
{
    public function question()
    {
        return $this->belongsTo('App\Question', 'question_id');
    }

    public function responses()
    {
        return $this->hasMany('App\Response', 'reponse_choice_id');
    }
}
