<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Instance;
use App\provider;
use App\Service;
use App\Classification as EconomicActivity;

class HomeController extends Controller
{

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


    public function welcome()
    {
        return view('welcome',[
            'cases' => Instance::inRandomOrder()->limit(6)->get(),
            'providers' => Provider::inRandomOrder()->limit(3)->get(),
        ]);
    }

}
