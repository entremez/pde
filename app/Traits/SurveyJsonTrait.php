<?php
namespace App\Traits;

use App\Survey;

trait SurveyJsonTrait {

    public function getJson(Survey $survey)
    {
        foreach ($survey->statements()->get() as $statement) {
            $responses['type'] = $statement->statement_type_id;
            $responses['statement_id'] = $statement->id;
            $responses['statement'] = $statement->statement;
            foreach ($statement->options as $option) {
                $opt['option_id'] = $option->id;
                $opt['option'] = $option->option;
                $opt['option_info'] = $option->info;
                $options[] = $opt;
            }
            $responses['options']=$options;
            $qr[] = $responses;
            $options=array();
        }
        return json_encode($qr);
    }

}