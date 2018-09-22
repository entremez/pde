<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instance;
use App\CounterController;

class InstanceController extends Controller
{
    public function index()
    {
        return view('index-cases', [
            'cases'  => Instance::inRandomOrder()->get()
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


