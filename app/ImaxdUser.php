<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImaxdUser extends Model
{
    public function hasEvaluationRunning(){
        $evaluation = ImaxdEvaluation::where('imaxd_user_id', $this->id)->get()->last();
        return isset($evaluation)? $evaluation->status != 3: false;
    }
}
