<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Provider;
use App\Instance;
use App\Service;
use App\ProviderService;
use App\Category;
use App\ProviderCounter;

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

    public function detail(Provider $provider)
    {
        $providerCounter = new ProviderCounter();
        $providerCounter->provider_id = $provider->id;
        $providerCounter->ip = request()->ip();
        $providerCounter->save();
        $services = $provider->services()->get();
        $service = new Collection();
        foreach ($services as $s) {
            $service->push($s->service()->first());
        }
        return view('provider',[
            'provider' => $provider,
            'cases' => Instance::where('provider_id','=', $provider->id)->get(),
            'service' => $service,
            'counterId' => $providerCounter->id
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
