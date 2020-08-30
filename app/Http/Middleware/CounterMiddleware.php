<?php

namespace App\Http\Middleware;

use Closure;
use App\Counter;

class CounterMiddleware
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
        $data = \Location::get(request()->ip());
        $exist = Counter::where('ip', $data->ip)
                        ->where('created_at', '>', \Carbon\Carbon::now()->subSeconds(6))->get()->count();
        if($data && $exist == 0){
            $counter = new Counter();
            $counter->ip = $data->ip;
            $counter->countryName = $data->countryName;
            $counter->countryCode = $data->countryCode;
            $counter->regionCode = $data->regionCode;
            $counter->regionName = $data->regionName;
            $counter->cityName = $data->cityName;
            $counter->zipCode = $data->zipCode;
            $counter->isoCode = $data->isoCode;
            $counter->postalCode = $data->postalCode;
            $counter->latitude = $data->latitude;
            $counter->longitude = $data->longitude;
            $counter->metroCode = $data->metroCode;
            $counter->areaCode = $data->areaCode;
            $counter->path = request()->path();
            $counter->user = null;
            if(auth()->check())
                $counter->user = auth()->user()->email;
            $counter->save();
        }
        return $next($request);
    }
}
