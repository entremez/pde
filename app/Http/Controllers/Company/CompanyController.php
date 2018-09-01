<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SurveyResponse as Travels;
use App\Survey;
use App\Traits\SurveyJsonTrait;


class CompanyController extends Controller
{

    use SurveyJsonTrait;

    public function index()
    {
        return view('company.dashboard',[
                'travels' => Travels::where('company_id',auth()->user()->id)->get(),
                'responses' => $this->getJson(Survey::where('active',1)->get()->first())
            ]);
    }

    public function results(Request $request)
    {
        dd($request);
    }

    public function timeline(){
        $surveys = auth()->user()->instance()->survey_responses();
        return view('company.timeline',[
            'number_of_surveys' => count($surveys->get()),
            'surveys' => $surveys->orderBy('created_at','desc')->get(),
        ]);
    }
}
