<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CompanySurvey;
use App\Response;
use App\Option;
use App\Service;

class Company extends Model
{
    protected $fillable = [
        'rut', 'dv_rut', 'name', 'address', 'user_id', 'classification_id', 'employees_id', 'gain_id', 'phone'
    ];

    public function survey_responses(){
        return $this->hasMany('App\SurveyResponse');
    }

    public function hasTravels()
    {
    	return CompanySurvey::where('company_id', $this->id)->get()->count() > 0;
    }

    public function lastTravel(){
        return CompanySurvey::where('company_id', $this->id)->orderBy('created_at', 'desc')->first();
    }   

    public function lastTravelDate(){
        return $this->fechaCastellano(CompanySurvey::where('company_id', $this->id)->orderBy('created_at', 'desc')->first()->created_at);
    }   

    public function sameLevel()
    {
        return rand(30,60);
    }

    public function stairs()
    {
        $lasttravel = $this->lastTravel();
        $responses = Response::where('company_survey_id', $lasttravel->id)->whereBetween('option_id', [11, 15])->get()->first()->option_id;
        $out = [];
        switch ($responses) {
            case 11:
                $out[0] = "el diseño se usa como parte central en la estrategia de tu organización.";
                $out[1] = asset('images/stairs/escala-4.png');
                return $out;
                break;
            case 12:
                $out[0] = "el diseño se usa como parte integral del desarrollo de productos o servicios en tu organización.";
                $out[1] = asset('images/stairs/escala-3.png');
                return $out;
                break;
            case 13:
                $out[0] = "el diseño se usa en la terminación, mejorando la apariencia y el atractivo de los productos o servicios de tu organización.";
                $out[1] = asset('images/stairs/escala-2.png');
                return $out;
                break;
            case 14:
                $out[0] = "el diseño no se usa tu organización.";
                $out[1] = asset('images/stairs/escala-1.png');
                return $out;
                break;
            case 15:
                $out[0] = "no tienes información de cómo se usa el diseño en tu organización.";
                $out[1] = asset('images/not-found.png');
                return $out;
                break;
        }
    }

    public function recomendation()
    {
        $lastTravel = $this->lastTravel();
        $out = [];
        $out[0] = $lastTravel->area->name;
        $out[1] = $lastTravel->service_id;
        $out[2] = asset('images/areas/'.$lastTravel->area->image);
        return $out;
    }

    public function getProviders($service)
    {
        $out = collect();
        foreach(Service::find($service)->providers as $serviceProvider) {
            $out->push($serviceProvider->provider);
        }
        return $out;
    }

    private function fechaCastellano ($fecha) 
    {
        $fecha = substr($fecha, 0, 10);
        $numeroDia = date('d', strtotime($fecha));
        $dia = date('l', strtotime($fecha));
        $mes = date('F', strtotime($fecha));
        $anio = date('Y', strtotime($fecha));
        $dias_ES = array("Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
        $dias_EN = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday");
        $nombredia = str_replace($dias_EN, $dias_ES, $dia);
        $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $nombreMes = str_replace($meses_EN, $meses_ES, $mes);
        return $numeroDia." de ".$nombreMes." de ".$anio;
    }
}
