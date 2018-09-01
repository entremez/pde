<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProviderCounter;

class CounterController extends Controller
{
    public function provider($id, Request $request)
    {
        $counter = new ProviderCounter();
        $counter->provider_id = $request->input('provider_id');
        $counter->ip = request()->ip();;
        $counter->save();
    }
}
