<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    public function statements()
    {
        return $this->hasMany('App\Statement');
    }

    public function numberOfQuestions()
    {
        $count = 0;
        foreach ($this->statements as $statement) {
            $count+=$statement->options->count();
        }
        return $count;
    }

    public function order()
    {
        foreach ($this->statements as $statement) {

            if($statement->statement_type_id == 3){
                foreach ($statement->options as $option) {
                    $order[] = $option->id;
                }
            }
            if($statement->statement_type_id == 4 || $statement->statement_type_id == 2){
                $order[] = $statement->options->first()->id;
            }
        }
        return json_encode($order);
    }
}
