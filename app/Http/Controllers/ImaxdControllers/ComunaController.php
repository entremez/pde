<?php

namespace App\Http\Controllers\ImaxdControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComunaController extends Controller
{
    public function getComunas($id_region)
    {
        return \App\Commune::where('city_id', $id_region)->get();
    }
}
