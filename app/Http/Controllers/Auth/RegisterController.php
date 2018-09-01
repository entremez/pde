<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Company;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Rules\RutCompanyUnique;
use App\Rules\RutValidate;
use Freshwork\ChileanBundle\Rut;
use Illuminate\Http\File;
use App\City;
use App\Employees;
use App\Gain;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('company.register',[
            'cities' => City::get(),
            'employees' => Employees::get(),
            'gains' => Gain::get()
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|min:6',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'rut' => ['required',new RutValidate(),new RutCompanyUnique()],
            'size' => 'required|integer|not_in:0'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $rut = $this->getRut($data['rut']);

        $user = User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => "Company"
        ]);

        $company = Company::create([
            'rut' => $rut[0],
            'dv_rut' => $rut[1],
            'name' => $data['name'],
            'address' => $data['address'],
            'user_id' => $user->id,
        ]);

        $user ->type_id = $company->id;
        $user->save();

        return $user;
    }

    private function getRut($rut){
         return Rut::parse($rut)->toArray();
    }
}
