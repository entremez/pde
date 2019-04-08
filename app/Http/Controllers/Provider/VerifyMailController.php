<?php

namespace App\Http\Controllers\Provider;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Provider;

class VerifyMailController extends Controller
{
    public function verify()
    {
    	return view('provider.verify');
    }

    public function verification(Request $request, $id, $token)
    {
    	$user = User::find($id);
    	if($user->remember_token != $token)
    		return response()->view('errors.404', [], 404);
    	$user->email_verified_at = now();
    	$user->save();
    	return redirect()->route('provider.dashboard');
    }
}
