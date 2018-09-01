<?php

namespace App\Http\Controllers\Admin\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provider;

class AdminProviderController extends Controller
{
    public function edit(Provider $provider)
    {
        return view('admin.provider.edit-provider')->with(compact('provider'));
    }
}
