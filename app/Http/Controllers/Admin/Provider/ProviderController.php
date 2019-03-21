<?php

namespace App\Http\Controllers\Admin\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provider;
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
}
