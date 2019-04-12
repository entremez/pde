<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/logout'
    ];

public function render($request, Exception $exception)
{
    if($exception instanceof \Illuminate\Session\TokenMismatchException){
        // token mismatch is a security concern, ensure logout.
        Auth::logout();

        // Tell the user what happened.
        session()->flash('alert-warning','Your session expired. Please login to continue.');

        // Go to login.
        return redirect()->route('login');
     }

    return parent::render($request, $exception);
}
}
