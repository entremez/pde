<?php

namespace App\Http\Controllers\Provider;

use App\User;
use App\Provider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use App\Rules\RutValidate;
use App\Rules\RutProviderUnique;
use Freshwork\ChileanBundle\Rut;

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
        return view('provider.register');
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
            'rut' => ['required',new RutValidate(),new RutProviderUnique()]
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
        $rut = Rut::parse($data['rut'])->toArray();
        $provider = Provider::create([
            'rut' => $rut[0],
            'dv_rut' => $rut[1],
            'name' => $data['name'],
            'address' => $data['address'],
        ]);

        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'type' => "Provider",
            'type_id' => $provider->id,
        ]);
    }
}
