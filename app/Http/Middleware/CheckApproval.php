<?php

namespace App\Http\Middleware;

use Closure;
use App\Instance;

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
        $instance = Instance::whereId(explode("/",$request->path())[1])->first();
        if($instance->approved)
            return $next($request);
        if(!auth()->check())
            abort(404);
        if(auth()->user()->instance()->id == $instance->provider_id)
            return $next($request);
        abort(404);
    }
}
