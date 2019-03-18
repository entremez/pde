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
            'intancesBuffered' => InstanceBuffer::get(),
            'providers' => Provider::get(),
            'providersBuffered' = ProviderBuffer::get()
        ]);
    }

    public function showProviders()
    {
        return view('admin/dashboard-providers',[
            'providers' => Provider::all()
        ]);
    }

    public function request()
    {
        $providers = Provider::all();
        return view('admin/dashboard-providers-request')->with(compact('providers'));
    }

    public function showCompanies()
    {
        $companies = Company::all();
        $providers = Provider::all();
        return view('admin/dashboard-companies')->with(compact('companies', 'providers'));
    }
}
