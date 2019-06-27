<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CompanyCity;

class City extends Model
{
    public static function countRegion()
    {
        foreach (City::all() as $key => $city) {
            $yes["name"] = $city->region;
            $yes["y"] =  CompanyCity::where('city_id', $city->id)->where('company_id','!=', 1)->where('company_id','!=', 2)->where('company_id','!=', 9)->get()->count();
            $out[] = $yes;
        }

        return json_encode($out);
    }
}
