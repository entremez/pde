<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Provider;
use App\Instance;
use App\Service;
use App\Category;
use App\ProviderCounter;

class ProviderController extends Controller
{
    public function show()
    {
        return view('providers',[
            'categories' => Category::get(),
            'services' => Service::get(),
            'providers' => Provider::where('approved',true)->inRandomOrder()->get(),
            'serviceFromBadge' => 0
            ]);
    }

    public function showFromBadge($service)
    {
        return view('providers',[
            'categories' => Category::get(),
            'services' => Service::get(),
            'providers' => Provider::where('approved',true)->inRandomOrder()->get(),
            'serviceFromBadge' => $service
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

        return view('providers',[
            'categories' => Category::get(),
            'services' => Service::get(),
            'providers' => Provider::where('approved',true)->inRandomOrder()->get(),
            'serviceFromBadge' => $serviceId
            ]);
    }

    public function detail(Provider $provider, Request $request)
    {
        return view('provider',[
            'provider' => $provider,
            'cases' => Instance::inRandomOrder()->limit(3)->where('provider_id',$provider->id)->get(),
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


