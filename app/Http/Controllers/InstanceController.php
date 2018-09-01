<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instance;
use App\InstanceCounter;

class InstanceController extends Controller
{
    public function index()
    {
        $cases = Instance::get();
        return view('index-cases')->with(compact('cases'));
    }
    public function show(Instance $instance)
    {
        $counter = new InstanceCounter();
        $counter->instance_id = $instance->id;
        $counter->ip = request()->ip();
        $counter->save();
        return view('cases',[
            'instance' => $instance,
            'provider' => $instance->provider()->first()
            ]);
    }

}
