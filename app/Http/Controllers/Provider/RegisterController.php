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
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

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
            'email-register' => 'required|string|email|max:255',
            'password-register' => 'required|string|min:6'
        ]);
    }
// 
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $user = User::create([
            'email' => $data['email-register'],
            'password' => bcrypt($data['password-register']),
            'role_id' => 2
        ]);

        $provider = Provider::create([
            'user_id' => $user->id,
        ]);

        $user ->type_id = $provider->id;
        $user->save();

        return $user;
    }



    public function register(Request $request)
    {

        $this->validator($request->all())->validate();        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
}
