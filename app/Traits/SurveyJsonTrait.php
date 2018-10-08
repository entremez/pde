<?php
namespace App\Traits;

use App\Survey;

trait SurveyJsonTrait {

    public function getJson(Survey $survey)
    {
        $responses = '{"qr":[';
        foreach ($survey->statements()->get() as $statement) {
            $type = $this->questionType($statement->statement_type_id);
            $responses .= '{"statement_type":"'.$type.'","statement_id":'.$statement->id.',"statement":"'.$statement->statement.'","options" : [';
            foreach ($statement->options()->get() as $option) {
                $responses.= '{"option_id":'.$option->id.',"option":"'.$option->option.'","info":"'.$option->info.'"},';
            }
            $responses = substr($responses, 0, -1);
            $responses.= ']},';
        }
        $responses = substr($responses, 0, -1);
        $responses .= ']}';
        return json_decode($responses, true);
    }

    private function questionType($type){
        if ($type == 1) {
            return "checkbox";
        }
        if ($type == 2) {
            return "radio";
        }
        return "affirmation";
    }
}