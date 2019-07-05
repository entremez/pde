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
use App\CompanySurvey;
use App\Funding;


class CompanyController extends Controller
{

    public function index()
    {
        $backgrounds = [asset('/images/FONDOS-01.png'), asset('/images/FONDOS-02.png'), asset('/images/FONDOS-03.png'), asset('/images/FONDOS-04.png'), asset('/images/FONDOS-05.png'), asset('/images/FONDOS-06.png'), asset('/images/FONDOS-07.png'), asset('/images/FONDOS-08.png')];
        $survey = Survey::where('active',1)->get()->first();
        if(Company::where('user_id',auth()->user()->id)->get()->count() == 0 ){
            return view('company.config',[
                'cities' => City::get(),
                'employees' => Employees::get(),
                'gains' => Gain::get(),
                'classifications' => Classification::get()
            ]);
        }

        return view('company.dashboard',[
                'company' => auth()->user()->instance(),
                'stages' => DpStage::all(),
                'statements' => $survey->statements()->get(),
                'survey' => $survey,
                'backgrounds' => $backgrounds,
                'fundings' => Funding::take(6)->get()
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

    public function timeline()
    {
        
        return view('company/timeline', [
                        'surveys' => CompanySurvey::where('company_id', auth()->user()->type_id)->where('active', false)->orderBy('created_at', 'desc')->get(),
                        'company' => auth()->user()->instance(),
                        'stages' => DpStage::all(),
                        'fundings' => Funding::take(6)->get()
                    ]);
    }

    public function popUp(Request $request)
    {
        $survey = CompanySurvey::find($request->input('id'));
        $response = collect();
        $response->put('date', $survey->getDate());
        $response->put('phrase', $survey->level->phrase);
        $response->put('percentage', $survey->company->sameLevelWithLevel($survey->level_id));
        $response->put('image-stair', asset('images/stairs/'.$survey->level->image));
        $providers = $survey->getProviders();
        $response->put('providers',$providers);
        $response->put('providers-image',$survey->getProvidersImage($providers));
        $response->put('area',$survey->area->name);
        $response->put('service',$survey->service->name);
        $response->put('image-area',asset('images/areas/'.$survey->area->image));
        $response->put('link-recommendation', route('providers-list-filtered', $survey->service_id));


        return response()->json($response);
    }

}
