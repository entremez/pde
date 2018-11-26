<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instance;
use App\CounterController;
use App\Employees;
use App\Sector;
use App\City;
use App\Category;

class InstanceController extends Controller
{
    public function index()
    {
        return view('index-cases', [
            'cases'  => Instance::where('approved', true)->inRandomOrder()->get(),
            'employees_range' => Employees::all(),
            'sectors' => Sector::all(),
            'cities' => City::all(),
            'sectors' => Sector::all(),
            'categories' => Category::all()
            ]);
    }
   
    public function show(Instance $instance)
    {
        $instance->counter(request()->ip());
        return view('cases',[
            'instance' => $instance,
            'provider' => $instance->provider()->first(),
            'cases' => Instance::where('provider_id',$instance->id)->inRandomOrder()->limit(3)->get()
            ]);
    }
}


