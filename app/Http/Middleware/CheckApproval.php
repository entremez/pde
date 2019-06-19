<?php

namespace App\Http\Middleware;

use Closure;
use App\Instance;
use App\Provider;

class CheckApproval
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
        switch (explode("/",$request->path())[0]) {
            case 'provider':
                $provider = Provider::whereId(explode("/",$request->path())[1])->first();
                if($provider->approved)
                    return $next($request);
                if(!auth()->check())
                    return response()->view('errors.404', [], 404);
                if(is_null(auth()->user()->type_id))
                    return response()->view('errors.404', [], 404);
                if( auth()->user()->role_id == 1 || auth()->user()->instance()->id == $provider->id)
                    return $next($request);
                return response()->view('errors.404', [], 404);
                break;
            
            case 'case':
                $instance = Instance::whereId(explode("/",$request->path())[1])->first();
                if($instance->approved)
                    return $next($request);
                if(!auth()->check())
                    return response()->view('errors.404', [], 404);
                if(is_null(auth()->user()->type_id))
                    return response()->view('errors.404', [], 404);
                if(auth()->user()->role_id == 1 || auth()->user()->instance()->id == $instance->provider_id)
                    return $next($request);
                return response()->view('errors.404', [], 404);
                break;
        }
    }
}
