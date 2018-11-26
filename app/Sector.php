<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public function classifications(){
        return $this->hasMany('App\Classification');
    }

    public function getTooltipAttribute(){
        $classifications = $this->classifications();

        $tooltip = "";
        foreach ($classifications->get()->all() as $classification) {
        	$tooltip.= $classification->classification.", ";
        }
        return trim($tooltip,', ');
    }
}
