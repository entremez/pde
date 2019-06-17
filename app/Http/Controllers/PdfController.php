<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanySurvey;

class PdfController extends Controller
{
    public function getTravel($id)
    {
	    $survey = CompanySurvey::find($id);


	    $pdf = \PDF::loadView('test',[
	                            'date' => $survey->getDate(),
	                            'area' => $survey->area->name,
	                            'imageArea' => $survey->area->image,
	                            'phrase' => $survey->level->phrase,
	                            'image' => $survey->level->image,
	                            'service' => $survey->service->name,
	                            'providers' => $survey->getProviders(),
	                            'company' => $survey->company->name
	                        ]);
	    return $pdf->download('Viaje.pdf');
    }
}
