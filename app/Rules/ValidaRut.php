<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Freshwork\ChileanBundle\Rut;

class ValidaRut implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $rut = Rut::parse($value)->toArray();
        if(Company::where('rut',$rut[0])->get())
            return false;
        return Rut::parse($value)->quiet()->validate() ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ingrese un rut válido.';
    }
}
