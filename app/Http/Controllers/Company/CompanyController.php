<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SurveyResponse as Travels;
use App\Survey;
use App\Traits\SurveyJsonTrait;
use App\Company;
use App\City;
use App\Employees;
use App\Gain;
use App\Classification;
use Freshwork\ChileanBundle\Rut;
use App\CompanyCity;


class CompanyController extends Controller
{

    use SurveyJsonTrait;

    public function index()
    {

        if(Company::where('user_id',auth()->user()->id)->count() == 0){
            return view('company.config',[
                'cities' => City::get(),
                'employees' => Employees::get(),
                'gains' => Gain::get(),
                'classifications' => Classification::get()
            ]);
        }

        return view('company.dashboard',[
                'travels' => Travels::where('company_id',auth()->user()->id)->get(),
                'responses' => $this->getJson(Survey::where('active',1)->get()->first())
            ]);
    }

    public function config(Request $request)
    {

        $rut = $this->getRut($request->input('rut'));
        $user = auth()->user();

        $company = Company::create([
                                    'rut' => $rut[0],
                                    'dv_rut' => $rut[1],
                                    'name' => $request->input('name'),
                                    'address' => $request->input('address'),
                                    'user_id' => $user->id,
                                    'classification_id' => $request->input('classification'),
                                    'employees_id' => $request->input('employees'),
                                    'gain_id' => $request->input('gains'),
                                    ]);

        foreach ($request->input('cities') as $city) {
            $companyCity = new CompanyCity();
            $companyCity->company_id = $company->id;
            $companyCity->city_id = $city;
            $companyCity->save();
        }

        $user->type_id = $company->id;
        $user->save();

        return redirect()->route('company.dashboard');
    }

    private function getRut($rut){
        return Rut::parse($rut)->toArray();
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
