<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CompanySurvey;
use App\Funding;

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
	                            'company' => $survey->company->name,
	                            'fundings' => Funding::take(2)->get()
	                        ]);
	    return $pdf->download('Viaje.pdf');
    }
}
