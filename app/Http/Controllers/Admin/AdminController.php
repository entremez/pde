<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provider;
use App\ProviderBuffer;
use App\Company;
use App\Instance;
use App\InstanceBuffer;
use App\CompanySurvey;
use Charts;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/dashboard', [
            'instances' => Instance::get(),
            'instancesApproved' => Instance::where('approved', true)->get(),
            'instancesWaitingForApproval' => Instance::where('approved', false)->get(),
            'intancesBuffered' => InstanceBuffer::get(),
            'providers' => Provider::get(),
            'providersApproved' => Provider::where('approved', true)->get(),
            'providersWaitinfForApproval' => Provider::where('approved', false)->get(),
            'providersBuffered' => ProviderBuffer::get()
        ]);
    }

}
