<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CompanyCity;

class City extends Model
{
    public static function countRegion()
    {
    	$yes = collect();
        foreach (City::all() as $key => $city) {
            $yes->push($city->region);
            //$yes["y"] =  CompanyCity::where('city_id', $city->id)->where('company_id','!=', 1)->where('company_id','!=', 2)->where('company_id','!=', 9)->get()->count();
            $out = $yes;
        }

        return json_encode($out);
    }

    public static function countRegionQty()
    {
    	$yes = collect();
        foreach (City::all() as $key => $city) {
            $yes->push(CompanyCity::where('city_id', $city->id)->where('company_id','!=', 1)->where('company_id','!=', 2)->where('company_id','!=', 9)->get()->count());
            $out = $yes;
        }
        return json_encode($out);
    }


    public static function countRegionf()
    {
    	$yes = collect();
        foreach (City::all() as $key => $city) {
            $yes->put($city->region ,CompanyCity::where('city_id', $city->id)->where('company_id','!=', 1)->where('company_id','!=', 2)->where('company_id','!=', 9)->get()->count());
        }

        return $yes->sort();
    }
}
