<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Provider;
use App\Instance;
use App\Service;
use App\Category;

class ProviderController extends Controller
{
    public function show()
    {
        return view('providers',[
            'categories' => Category::get(),
            'services' => Service::get(),
            'providers' => Provider::where('approved','1')->inRandomOrder()->get()
            ]);
    }

    public function filtered(Request $request, $serviceId)
    {
        if($request->ajax()){
            $service = Service::find($serviceId);
            $providers = $service->providers()->get();
            $providersFiltered = new Collection();
            foreach ($providers as $provider) {
                $providersFiltered->push($provider->provider()->first());
            }
            return $providersFiltered;
        }
    }

    public function detail(Provider $provider, Request $request)
    {
        return view('provider',[
            'provider' => $provider,
            'cases' => Instance::inRandomOrder()->limit(3)->get(),
            'service' => $provider->allServicesJson,
            'counterId' => $provider->counter($request->ip())
            ]);
    }

    public function counterClick(Request $request, $providerId)
    {
        if($request->ajax()){
            $counter = ProviderCounter::find($request->input('counter_id'));
            $counter->contact_click = now();
            $counter->save();
        }
    }
}


