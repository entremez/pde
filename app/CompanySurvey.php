<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Provider;

class CompanySurvey extends Model
{
    public function area()
    {
    	return $this->hasOne('App\Area' ,'id','area_id');
    }

    public function service()
    {
    	return $this->hasOne('App\Service' ,'id','service_id');
    }

    public function company()
    {
    	return $this->hasOne('App\Company' ,'id','company_id');
    }

    public function level()
    {
    	return $this->hasOne('App\Level' ,'id','level_id');
    }

    public function getProviders()
    {
        $providers = Provider::where('approved', true)->get();

        $out = collect();
        $count = 0;
        foreach ($providers as $provider) {
            foreach($provider->services as $service){
                if($service->service_id == $this->service_id){
                    $out->push($provider);
                    $count++;  
                    break;
                }               
            }
            if($count == 6)
                break;
        }
        return $out;
    }

    public function getProvidersImage($providers)
    {
        $out = collect();
        foreach ($providers as $provider) {
            $out->push($provider->imagen_logo);
        }
        return $out;
    }

    public function getDate()
    {
        return $this->fechaCastellano($this->created_at);
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
