<?php

namespace App\Http\Controllers\Admin\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provider;
use App\ProviderBuffer;
use App\Instance;

class ProviderController extends Controller
{
    public function approveProvider(Provider $provider)
    {
        $provider->approved = true;
        $provider->save();
        return redirect()->back();
    }

    public function approveInstance(Instance $instance)
    {
        $instance->approved = true;
        $instance->save();
        return redirect()->back();
    }

    public function providerBuffered(Provider $provider)
    {
        $providerBuffered = ProviderBuffer::where('provider_id', $provider->id)->first();

        return view('provider-buffered',[
            'provider' => $provider,
            'providerBuffered' => $providerBuffered,
            'serviceBuffered' => $providerBuffered->allServicesJson,
            'service' => $provider->allServicesJson,
            ]);
    }
}
