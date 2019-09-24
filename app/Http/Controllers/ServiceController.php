<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service;
use App\Instance;

class ServiceController extends Controller
{
    public function show()
    {
        return view('services', [
        	'services' => Service::all()
        ]);
    }

    public function save(Request $request)
    {
        $service = Service::find($request->input('serviceId'));
        $service->name = $request->input('name');
        $service->description = $request->input('description');
        $service->save();
        return redirect()->back();
    }

}
