<?php

namespace App\Http\Controllers\Company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CompanySurvey as Travels;
use App\Survey;
use App\Company;
use App\City;
use App\Employees;
use App\Gain;
use App\Classification;
use Freshwork\ChileanBundle\Rut;
use App\CompanyCity;
use App\DpStage;


class CompanyController extends Controller
{

    public function index()
    {
        if(Company::where('user_id',auth()->user()->id)->get()->count() == 0 ){
            return view('company.config',[
                'cities' => City::get(),
                'employees' => Employees::get(),
                'gains' => Gain::get(),
                'classifications' => Classification::get()
            ]);
        }

        return view('company.dashboard',[
                'data' => auth()->user()->instance(),
                'stages' => DpStage::all()
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
                                    'gain_id' => $request->input('gain'),
                                    'phone' => $request->input('phone'),
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

}
