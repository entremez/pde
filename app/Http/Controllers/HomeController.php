<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Instance;
use App\Provider;
use App\Service;
use App\Classification as EconomicActivity;
use Illuminate\Support\Collection;
use App\Team;

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
            'cases' => $this->notSoRandom(3,3),
            'providers' => Provider::where('approved',true)->inRandomOrder()->limit(3)->get(),
        ]);
    }


    public function welcomeSoon()
    {
        return view('soon');
    }


    public function resources()
    {
        return view('resources');
    }


    public function evaluate()
    {
        return view('evaluate');
    }

    public function team()
    {
        return view('team',[
                        'team' => Team::all()
                    ]);
    }

    private function notSoRandom($featured, $normal)
    {
        $instances = collect();
        foreach(Instance::where('approved',true)->where('featured',true)->inRandomOrder()->limit($featured)->get() as $instance){
            $instances->push($instance);
        }

        $normal = $featured - $instances->count() + $normal;

        foreach(Instance::where('approved',true)->where('featured',false)->inRandomOrder()->limit($normal)->get() as $instance){
            $instances->push($instance);
        }
        return $instances;
    }
}
