<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Company;
use App\Provider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\File;
use App\City;
use App\Employees;
use App\Gain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Mail\FirstStep;
use Illuminate\Support\Facades\Mail;

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
            'email-register' => 'required|string|email|max:255|unique:users,email',
            'password-register' => 'required|string|min:6'
        ],[
            'email-register.unique' => '*Correo electrónico ya registrado.',
        ]);
    }


    public function register(Request $request)
    {
        $this->validator($request->all())->validate();


            event(new Registered($user = $this->create($request->all())));


        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
        
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $role = 3;
        if(isset($data['provider']))
            $role = 2;

        $user = User::create([
            'email' => $data['email-register'],
            'password' => bcrypt($data['password-register']),
            'role_id' => $role
        ]);

        isset($data['provider']) ? $this->createProvider($user) : '';

        return $user;
    }

    private function createProvider(User $user){

        $token = str_random(16);
        $user->remember_token = $token;
        $user->save();

        Mail::send(new FirstStep($user, $token));

    }


}
