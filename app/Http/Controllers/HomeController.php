<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Instance;
use App\Provider;
use App\Service;
use App\Classification as EconomicActivity;

class HomeController extends Controller
{
    public function index()
    {
        if(auth()->check()){
            switch(auth()->user()->role_id){
                case 1:
                    return redirect()->route('admin.dashboard');
                    break;
                case 2:
                    return redirect()->route('provider.dashboard');
                    break;
                case 3:
                    return redirect()->route('company.dashboard');
                    break;
            }
        }
        return redirect()->route('welcome');
    }


    public function welcome()
    {
        return view('welcome',[
            'cases' => Instance::where('approved',true)->inRandomOrder()->limit(6)->get(),
            'providers' => Provider::where('approved',true)->inRandomOrder()->limit(3)->get(),
        ]);
    }


    public function resources()
    {
        return view('resources');
    }


    public function evaluate()
    {
        return view('evaluate');
    }

}
