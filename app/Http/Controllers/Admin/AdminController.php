<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Provider;
use App\Company;
use App\Instance;
use App\CompanySurvey;
use Charts;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin/dashboard');
    }

    public function showProviders()
    {
        $providers = Provider::all();
        return view('admin/dashboard-providers')->with(compact('providers'));
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
