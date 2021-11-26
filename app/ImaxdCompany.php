<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\Request;

class ImaxdCompany extends Model
{
    public function isPdeFullyAnswered($json_responses)
    {
        foreach(json_decode($json_responses, true) as $pde) {
            switch ($pde['statement_type_id']) {
                case 1:
                    foreach($pde['response'] as $response){
                        if($response == true){
                            $out_1 = true;
                            break;
                        }
                    }
                    break;
                case 2:
                    if($pde['response'] != null){
                        $out_2 = true;
                        break;
                    }
                    break;
                case 3:
                    foreach($pde['response'] as $response){ 
                        if($response == 0){
                            $aux_3[] = false;
                        }else{
                            $aux_3[] = true;
                        }
                    }
                    break;
            }
        }
        $out_3 = true;
        foreach($aux_3 as $aux){
            if($aux == false){
                $out_3 = false;
            }
        }
        
        $is_full = $out_1 && $out_2 && $out_3;


        return  $is_full;

    }
}
