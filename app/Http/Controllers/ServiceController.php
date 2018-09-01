<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Instance;

class ServiceController extends Controller
{
    public function show(Service $service)
    {
        $instances = $service->instances()->inRandomOrder()->get();
        return view('services')->with(compact('instances', 'service'));
    }
}
