<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Instance;
use App\User;
use App\provider;
use App\Service;
use App\Classification as EconomicActivity;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->check()){
            switch(auth()->user()->type){
                case "Admin":
                    return redirect()->route('admin.dashboard');
                    break;
                case "Provider":
                    return redirect()->route('provider.dashboard');
                    break;
                case "Company":
                    return redirect()->route('company.dashboard');
                    break;
            }
        }
        return view('auth.login');
    }

    public function FunctionName($value='')
    {
        # code...
    }

    public function welcome()
    {
        return view('welcome',[
            'cases' => Instance::inRandomOrder()->limit(6)->get(),
            'providers' => Provider::inRandomOrder()->limit(3)->get(),
            'economic_activitys' => EconomicActivity::get()
        ]);
    }

    public function evaluate()
    {
        return view('evaluate');
    }

    public function viewMore(Request $request)
    {
        $output = '';
        $id = $request->id;

        if($request->input('type') == 'service'){
            $services = Service::where('id','>',$id)->orderBy('created_at','DESC')->limit(6)->get();
            $numberOfServices = Service::count();

            if(!$services->isEmpty())
            {
                foreach($services as $service)
                {
                    $output .= '<div class="col-md-4 ">
                                    <div class="service">
                                        <div class="image-service">
                                            <img class="d-block w-100" src="http://via.placeholder.com/500x300">
                                        </div>
                                        <div class="footer-service">
                                        <p>Diseño aplicado en '. $service->name .'</p>
                                        </div>
                                    </div>
                                </div>';
                }

                if($service->id != $numberOfServices){
                    $output .= '<div id="remove-row" class="text-center">
                                    <form method="post" action="'.route('welcome.load.more').'" id="form-load-more">
                                        '.csrf_field().'
                                         <input type="hidden" name="type" value="service">
                                        <input type="hidden" name="id" value="'. $service->id .'">
                                        <button id="view-more-home" class="btn btn-success" data-id = "'. $service->id .'">Ver más</button>
                                    </form>
                                </div>';
                    }
                return $output;
            }
        }else{

            $providers = Provider::where('id','>',$id)->orderBy('created_at','DESC')->limit(3)->get();
            $numberOfProviders = Provider::count();

            if(!$providers->isEmpty())
            {
                foreach($providers as $provider)
                {
                    $output .= '<div class="col-md-4 ">
                                    <div>
                                        <div class="image-provider">
                                            <img class = "image" class="d-block w-100" src="'. $provider->logo .'">
                                            <div class="middle">
                                                <div class="text">'. $provider->name .'</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pb-3">

                                    </div>
                                </div>';
                }

                if($provider->id < $numberOfProviders){
                    $output .= '<div id="remove-row-provider" class="text-center">
                                    <form method="post" action="'. route('welcome.load.more') .'" id="form-providers">
                                        '. csrf_field() .'
                                        <input type="hidden" name="type" value="provider">
                                        <input type="hidden" name="id" value="'. $provider->id .'">
                                        <button id="view-more-providers" class="btn btn-success" >Ver más</button>
                                    </form>
                                </div>';
                    }
                return $output;
            }
        }
    }

}
