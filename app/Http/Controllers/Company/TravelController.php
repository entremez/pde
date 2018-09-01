<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Survey as Survey;
use App\Response as Response;
use App\SurveyResponse as SurveyResponse;
use App\Company as Company;
use App\ResponseChoice as ResponseChoice;
use App\Question as Question;

class TravelController extends Controller
{
    public function travel()
    {
        $survey = Survey::where('active',1)->get()->first();
        return view('company.travel')->with(compact('survey'));
    }

    public function responses(Request $request){

        $responses = Response::where('survey_response_id',20)->get();
        $result = 0;
        foreach ($responses as $response) {
            $factor = $response->total;
            $weight = $response->response_choice()->get()->first()->weight;
            $result += $factor*$weight;
        }

        $companyId = $request->input('company');
        $surveyId = $request->input('survey');
        $audit =
            [
                'date' => date("d-m-Y G:i:s"),
                'company' => Company::find($companyId)->name,
                'survey' => Survey::find($surveyId)->name,
                'question' => '',
                'response' => '',
                'weight' => 0,
                'total' => 0
            ];
        $surveyResponse = new SurveyResponse();
        $surveyResponse->survey_id = $surveyId;
        $surveyResponse->company_id = $companyId;
        $surveyResponse->save();

        foreach ($request->input('response') as $key => $responses) {
            if(is_array($responses)){
                foreach ($responses as $key => $value) {
                    $response = New Response();
                    $response->survey_response_id = $surveyResponse->id;
                    $response->response_choice_id = $key;
                    $response->total = $value;
                    $audit['question'] = Question::find(ResponseChoice::find($key)->question_id)->question;
                    $audit['response'] = ResponseChoice::find($key)->response;
                    $audit['weight'] = ResponseChoice::find($key)->weight;
                    $audit['total'] = ResponseChoice::find($key)->weight * $value;
                    $response->audit = json_encode($audit);
                    $response->save();
                }
            }else{
                $response = New Response();
                $response->survey_response_id = $surveyResponse->id;
                $response->response_choice_id = $responses;
                $response->total=1;
                $audit['question'] = Question::find(ResponseChoice::find($responses)->question_id)->question;
                $audit['response'] = ResponseChoice::find($responses)->response;
                $audit['weight'] = ResponseChoice::find($responses)->weight;
                $audit['total'] = ResponseChoice::find($responses)->weight;
                $response->audit = json_encode($audit);
                $response->save();
            }
        }

        $responses = Response::where('survey_response_id',$surveyResponse->id)->get();
        foreach ($responses as $response) {
            $factor = $response->total;
            $weight = $response->response_choice()->get()->first()->question()->get()->first()->weight;
            $result += $factor*$weight;
        }
        return redirect()->route('company.dashboard');
    }
}
