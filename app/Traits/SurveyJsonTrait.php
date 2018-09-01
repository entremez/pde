<?php
namespace App\Traits;

use App\Survey;

trait SurveyJsonTrait {

    public function getJson(Survey $survey)
    {
        $responses = '{"qr":[';
        foreach ($survey->survey_questions()->get() as $question) {
            $type = $this->questionType($question->question->question_type()->get()->first()->type);
            $responses .= '{"question_type":"'.$type.'","question_id":'.$question->question->id.',"question":"'.$question->question->question.'","responses" : [';
            foreach ($question->question->response_choices()->get() as $response) {
                $responses.= '{"response_id":'.$response->id.',"response":"'.$response->response.'"},';
            }
            $responses = substr($responses, 0, -1);
            $responses.= ']},';
        }
        $responses = substr($responses, 0, -1);
        $responses .= ']}';
        return json_decode($responses, true);
    }

    private function questionType($type){
        if ($type == "Selección múltiple") {
            return "checkbox";
        }elseif ($type == "Selección única") {
            return "radio";
        }
    }
}