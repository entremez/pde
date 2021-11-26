<?php

namespace App\Http\Controllers\ImaxdControllers;

use finfo;
use App\City;
use App\ImaxdCity;
use App\ImaxdUser;
use App\Statement;
use App\Activities;
use App\CompanySize;
use App\ImaxdCompany;
use App\ImaxdOptions;
use App\ImaxdActivity;
use App\ImaxdEvaluation;
use Illuminate\Http\Request;
use Freshwork\ChileanBundle\Rut;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function getHome()
    {
        return view('imaxd/home');
    }

    public function getDashboard(Request $request)
    {
        $user_id = Auth::user()->id;
        $imaxd_user = ImaxdUser::where('user_id', $user_id)->first();
        if(ImaxdUser::where('user_id', $user_id)->count() <= 0){
            return view('imaxd.config',[
                'cities' => City::get(),
                'company_sizes' => CompanySize::get()
            ]);
        }else{
            return view('imaxd.dashboard', [
                'user' => $imaxd_user,
                'has_evaluation_done' => ImaxdEvaluation::where('imaxd_user_id', $imaxd_user->id)
                                                        ->where('status', 3)->get()->count() > 0,
                'older_evaluations' => ImaxdEvaluation::where('imaxd_user_id', $imaxd_user->id)
                                                        ->where('status', 3)->get()
            ]);
        }

    }

    public function config(Request $request)
    {
        $imaxd_user = new ImaxdUser();
        $imaxd_user->user_id = Auth::user()->id;
        $imaxd_user->full_name = $request->input('full_name');


        $rut = Rut::parse($request->input('rut'))->toArray();
        $imaxd_user->rut = $rut[0];
        $imaxd_user->dv_rut = $rut[1];

        $imaxd_user->type = $request->input('radio'); 
        $imaxd_user->company_name = $request->input('company_name');

        $rut = Rut::parse($request->input('company_rut'))->toArray();
        $imaxd_user->company_rut = $rut[0];
        $imaxd_user->company_dv_rut = $rut[1];

        $imaxd_user->ocupation = $request->input('ocupation');
        $imaxd_user->address = $request->input('address'); 
        $imaxd_user->region_id = $request->input('region'); 
        $imaxd_user->commune_id = $request->input('comuna'); 
        $imaxd_user->city = $request->input('city'); 
        $imaxd_user->phone = $request->input('phone'); 
        $imaxd_user->mobile_phone = $request->input('mobile_phone');
        $imaxd_user->web = $request->input('web'); 
        $imaxd_user->notification_mail = $request->input('notification_email'); 
        $imaxd_user->company_size_id = $request->input('company_size');
        $imaxd_user->save();

        return redirect()->route('imaxd-dashboard');

    }

    public function getEvaluation()
    {
        $imaxd_user = Auth::user()->getImaxdUser;
        $status_evaluation = ImaxdEvaluation::where('imaxd_user_id', $imaxd_user->id)->get()->last();

        if( $status_evaluation == null || $status_evaluation->status == 3){
            $evaluation = new ImaxdEvaluation();
            $evaluation->imaxd_user_id = $imaxd_user->id;
            $evaluation->status = 0;
            $evaluation->imaxd_options_id = $this->getActiveOption();
            $evaluation->save();
            return view('imaxd.evaluation', [
                'user' => ImaxdUser::where('user_id', Auth::user()->id)->first()->full_name,
                'cities' => City::take(16)->get(),
                'activities' => Activities::get(),
                'evaluation' => ImaxdEvaluation::where('imaxd_user_id', $imaxd_user->id)->get()->last(),
                'company' => ImaxdCompany::where('imaxd_evaluation_id', $status_evaluation->id)
                                            ->get()->last(),
            ]);
        }
        if( $status_evaluation->status == 0){
            return view('imaxd.evaluation', [
                'user' => ImaxdUser::where('user_id', Auth::user()->id)->first()->full_name,
                'cities' => City::take(16)->get(),
                'activities' => Activities::get(),
                'evaluation' => ImaxdEvaluation::where('imaxd_user_id', $imaxd_user->id)
                                                ->with('activities')
                                                ->with('cities')
                                                ->get()->last(),
                'company' => ImaxdCompany::where('imaxd_evaluation_id', $status_evaluation->id)
                                            ->get()->last(),
            ]);
        }
        if($status_evaluation->status == 1 || $status_evaluation->status == 2){
            $responses = ImaxdCompany::where('imaxd_evaluation_id', $status_evaluation->id)->first()->pde;
            $statements = Statement::where('id', '<>', 1)->with('options')->get();
            return view('imaxd.evaluation-design',[
                'user_id' => ImaxdUser::where('user_id', Auth::user()->id)->first()->id,
                'statements' => $statements,
                'responses' => $responses,
                'order' => $this->getOrder($statements, $responses),
                'evaluation' => ImaxdEvaluation::where('imaxd_user_id', $imaxd_user->id)->get()->last(),
                'company' => ImaxdCompany::where('imaxd_evaluation_id', $status_evaluation->id)
                                            ->get()->last(),
            ]);
        }

    }

    public function evaluation(Request $request)
    {
        $imaxd_user = Auth::user()->getImaxdUser;
        $evaluation_id = ImaxdEvaluation::where('imaxd_user_id', $imaxd_user->id)->get()->last()->id;
        $imaxd_company = ImaxdCompany::where('imaxd_evaluation_id', $evaluation_id)->first();
        if($imaxd_company == null){
            $imaxd_company = new ImaxdCompany();
            $imaxd_company->imaxd_evaluation_id = $evaluation_id;
            $imaxd_company->pde = $this->getPdeSurvey();
            $imaxd_company->save();
        }
        if(isset($request->is_company))
            $imaxd_company->startup_statement = $request->input('is_company');
        if(isset($request->food_res))
            $imaxd_company->sanitary_resolution = $request->input('food_res');
        $imaxd_company->save();

        ImaxdActivity::where('imaxd_evaluation_id', $evaluation_id)->delete();
        if(isset($request->activity) && count($request->activity) > 0){
            foreach ($request->activity as $value) {
                $activity = new ImaxdActivity();
                $activity->imaxd_evaluation_id = $evaluation_id;
                $activity->activity_id = $value;
                $activity->save();
            }
        }

        ImaxdCity::where('imaxd_evaluation_id', $evaluation_id)->delete();
        if(isset($request->region) && count($request->region) > 0){
            foreach ($request->region as $value) {
                $city = new ImaxdCity();
                $city->imaxd_evaluation_id = $evaluation_id;
                $city->region_id = $value;
                $city->save();
            }
        }

        if($request->just_save == "false"){
                $imaxd_evaluation = ImaxdEvaluation::where('imaxd_user_id', $imaxd_user->id)->get()->last();
                $imaxd_evaluation->status = 2;
                $imaxd_evaluation->save();
                return redirect()->route('imaxd-evaluate');
        }

        
        return redirect()->back();
    }

    public function evaluationDesign(Request $request)
    {
        $evaluation = ImaxdEvaluation::where('imaxd_user_id', Auth::user()->getImaxdUser->id)
                                        ->where('status', 2)->get()->last();
        $evaluation_pde = ImaxdCompany::where('imaxd_evaluation_id', $evaluation->id)->first();

        $responses = json_decode($evaluation_pde->pde, true);
        foreach($responses as $key => $value){
            if($value['statement_id'] == 2){
                if(isset($request->all()['design_types'])){
                    foreach($responses[$key]['response'] as $key_2 => $reset_response){
                        $responses[$key]['response'][$key_2] = false;
                    }
                    foreach($request->design_types as $type){
                        $responses[$key]['response'][$type] = true;
                    }
                }
            }
            if($value['statement_id'] == 3){
                if(isset($request->all()[3]))
                    $responses[$key]['response'] = $request->all()[3];
            }
            if($value['statement_id'] == 4){
                foreach(range(16, 20) as $number){
                    if(isset($request->all()[$number])){
                        $responses[$key]['response'][$number] = $request->all()[$number];
                    }
                }
            }
            if($value['statement_id'] == 5){
                foreach(range(21, 23) as $number){
                    if(isset($request->all()[$number])){
                        $responses[$key]['response'][$number] = $request->all()[$number];
                    }
                }
            }
            if($value['statement_id'] == 6){
                foreach(range(24, 28) as $number){
                    if(isset($request->all()[$number])){
                        $responses[$key]['response'][$number] = $request->all()[$number];
                    }
                }
            }
            if($value['statement_id'] == 6){
                foreach(range(24, 28) as $number){
                    if(isset($request->all()[$number])){
                        $responses[$key]['response'][$number] = $request->all()[$number];
                    }
                }
            }
            if($value['statement_id'] == 7){
                foreach(range(29, 33) as $number){
                    if(isset($request->all()[$number])){
                        $responses[$key]['response'][$number] = $request->all()[$number];
                    }
                }
            }
            if(isset($request->all()['order_end']) && $value['statement_id'] == 8){
                $arreglo =json_decode($request->all()['order_end'], true);
                foreach($arreglo as $key_arreglo => $value){
                    $responses[$key]['response'][$value['id']] = $key_arreglo+1;
                }
            }
        }

        $evaluation_pde->pde = json_encode($responses);
        $evaluation_pde->save();
        $evaluation->status = 2;
        $evaluation->save();

        if($request->just_save == "false"){
            if($evaluation_pde->isPdeFullyAnswered($evaluation_pde->pde)){
                $evaluation->status = 3;
                $evaluation->apt = $evaluation->isElegible();
                $evaluation->save();
            }
            return redirect()->route('imaxd-result');
        }
        return redirect()->back();
    }

    private function getPdeSurvey()
    {
        $out = collect();
        foreach(Statement::where('id', '<>', 1)->with('options')->get() as $statement){
            switch ($statement->statement_type_id) {
                case 1:
                    $stm_id['statement_type_id'] = $statement->statement_type_id;
                    $stm_id['statement_id'] = $statement->id;
                    $stm_id['options'] = $statement->options->pluck('id')->toArray();
                    foreach($statement->options->pluck('id') as $option){
                        $response[$option] = false;
                    }
                    $stm_id['response'] = $response;
                    $out->push($stm_id);
                    $stm_id = [];
                    $response = [];
                    break;
                case 2:
                    $stm_id['statement_type_id'] = $statement->statement_type_id;
                    $stm_id['statement_id'] = $statement->id;
                    $stm_id['options'] = $statement->options->pluck('id')->toArray();
                    $stm_id['response'] = null;
                    $out->push($stm_id);
                    break;
                case 3:
                    $stm_id['statement_type_id'] = $statement->statement_type_id;
                    $stm_id['statement_id'] = $statement->id;
                    $stm_id['options'] = $statement->options->pluck('id')->toArray();
                    foreach($statement->options->pluck('id') as $option){
                        $response[$option] = 0;
                    }
                    $stm_id['response'] = $response;
                    $out->push($stm_id);
                    $stm_id = [];
                    $response = [];
                    break;
                case 4:
                    $stm_id['statement_type_id'] = $statement->statement_type_id;
                    $stm_id['statement_id'] = $statement->id;
                    $stm_id['options'] = $statement->options->pluck('id')->toArray();
                    foreach($statement->options->pluck('id') as $key => $option){
                        $response[$option] = $key + 1;
                    }
                    $stm_id['response'] = $response;
                    $out->push($stm_id);
                    $stm_id = [];
                    $response = [];
                    break;
            }    
        }
        return json_encode($out);
    }

    private function getOrder($statements, $responses){
        $out = collect();
        foreach(json_decode($responses, true)[6]['response'] as $key => $value){
            $out->put($value-1, $statements->where('statement_type_id', 4)->first()->options->where('id', $key)->first());
        }
        return $out->sortKeys();
    }
    
    public function isFull(Request $request)
    {
        $evaluation = ImaxdEvaluation::where('imaxd_user_id',$request->imaxd_user_id)
                                        ->where('status', 2)->get()->last();
        $evaluation_pde = ImaxdCompany::where('imaxd_evaluation_id', $evaluation->id)->first();
        return $evaluation_pde->isPdeFullyAnswered($request->json_responses)? 'true' : 'false';
    }

    public function getResult()
    {
       
        $imaxd_user = Auth::user()->getImaxdUser;
        $status_evaluation = ImaxdEvaluation::where('imaxd_user_id', $imaxd_user->id)
                                                ->where('status', 3)
                                                ->with('companies')->get()->last();
        return view('imaxd.result',[
                'results' => $status_evaluation,
                'is_elegible' => $status_evaluation->isElegible()
            ]);                                                   
    }

    private function getActiveOption(){
        return ImaxdOptions::where('is_active', 1)->get()->last()->id;
    }
}
