<?php

namespace App\Http\Middleware;

use Closure;

class VerifyProviderMail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(is_null(auth()->user()->email_verified_at))
            return redirect()->route('verify');
        return $next($request);
    }
}
