<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    public function statement_type()
    {
        return $this->hasOne('App\StatementType', 'id');
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
}
