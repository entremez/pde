<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPassword;

class NewPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
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
        
    }

    public function new()
    {
        return view('provider/new-password');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $newPassword = $request->input('password');
        $user = auth()->user();
        $user->password = bcrypt($newPassword);
        $user->save();
        Mail::send(new NewPassword($user->email));
        return redirect()->route('home');
    }
}