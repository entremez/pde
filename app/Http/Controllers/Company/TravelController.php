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
use App\Option;
use App\CompanySurvey;
use App\User;
use App\Area;
use App\Statement;
use App\RecommendedService;
use App\Level;

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

        $options = Option::get();

        $recommended_area = $this->getRecomendedArea($options, $request);
        $service_id = $this->getRecomendedService($recommended_area, $request)->id;
        $level = $this->getLevel($request);
        $survey =  $this->getCompanySurvey(auth()->user());

        foreach ($request->input('survey') as $key => $value) {   
            if($value != null){         
                $response = new Response();
                $response->company_survey_id = $survey->id;
                $response->option_id = $options[$key]->id;
                if($options[$key]->statement->statement_type_id == 3 
                    OR $options[$key]->statement->statement_type_id == 4)
                {
                    $response->value = $value;
                }
                $response->save();
            }
        }

        $survey->active = false;
        $survey->area_id = $recommended_area->id;
        $survey->service_id = $service_id;
        $survey->level_id = $level->id;
        $survey->save();

        return redirect()->route('home');
    }

    private function getCompanySurvey(User $user){
        $survey = CompanySurvey::where('active', true)->where('company_id', $user->type_id)->first();
        if( $survey != null)
            return $survey;
        $survey = new CompanySurvey();
        $survey->company_id = $user->type_id;
        $survey->survey_id = Survey::where('active',1)->get()->first()->id;
        $survey->save();
        return $survey;
    }

    public function lastTravel(){
        return CompanySurvey::where('company_id', auth()->user()->type_id)->orderBy('created_at', 'desc')->first();
    } 

    protected $start_question = 33;
    protected $end_question = 36;

    private function getRecomendedArea($options, $request)
    {
        $response = collect();
        foreach ($request->input('survey') as $key => $value) {
            if($key >= $this->start_question and $key <= $this->end_question)
                $response->put($key,$value);
        }
        $response = $response->flip()->sortKeys()->last();
        $area = Area::where('option_id',$response+1)->first();
        return $area;
    }

    protected $productDesign = 22;
    protected $serviceDesign = 38;

    private function getRecomendedService($recommended_area, $request)
    {
        $aux = collect();
        $first = Statement::find($recommended_area->statement_id)->options->first()->id;
        $last = Statement::find($recommended_area->statement_id)->options->last()->id;
        for ($i=$first-1; $i < $last; $i++) { 
            $aux->put($i, $request->input('survey')[$i]);
        }

        $lower_response = $aux->sort()->keys()->first() + 1; //se suma 1 para contrarrestar el inicio del array en 0.

        $services = RecommendedService::where('option_id', $lower_response)->get();

        $serviceContainer = collect();
        $servicesId = collect();

        foreach ($services as  $service) {
            if($service->services->id == $this->productDesign && 
                $request->input('survey')[1] == 2)
                continue;
            if($service->services->id == $this->serviceDesign && 
                $request->input('survey')[0] == 1)
                continue;
            $serviceContainer->push($service->services);
            $servicesId->push($service->services->id);
        };

        if(!$this->hasPreviousTravel())
            return $serviceContainer->first();
        $lastTravelService = $this->lastTravel()->service_id;
        $key_last = $servicesId->search($lastTravelService, true);
        if(!is_numeric($key_last))
            return $serviceContainer->first();
        if($key_last == $servicesId->count()-1)
            return $serviceContainer->first();
        return $serviceContainer[$key_last+1];
    }

    protected $firstLevel = 11;
    protected $lastLevel = 15;

    private function getLevel($options)
    {
        for($i=$this->firstLevel-1; $i <= $this->lastLevel-1; $i++) { 
            if($options->input('survey')[$i] != null){
                $option =  $i+1;
            }
        }
        return Level::where('option_id', $option)->first();
    }

    private function hasPreviousTravel()
    {
        return CompanySurvey::where('active', false)->where('company_id', auth()->user()->type_id)->get()->count() > 0;
    }
}
