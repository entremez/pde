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
use App\Traits\SurveyJsonTrait;

class TravelController extends Controller
{
    use SurveyJsonTrait;

    public function travel()
    {
        $backgrounds = [asset('/images/FONDOS-01.png'), asset('/images/FONDOS-02.png'), asset('/images/FONDOS-03.png'), asset('/images/FONDOS-04.png'), asset('/images/FONDOS-05.png'), asset('/images/FONDOS-06.png'), asset('/images/FONDOS-07.png'), asset('/images/FONDOS-08.png')];
        $survey = Survey::where('active',1)->get()->first();
        return view('company.travel-test',[
                'statements' => $survey->statements()->get(),
                'survey' => $survey,
                'backgrounds' => $backgrounds
        ]);
    }

    public function responses(Request $request){

        dd($request);
    }
}
