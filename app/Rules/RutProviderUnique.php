<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Provider;
use Freshwork\ChileanBundle\Rut;

class RutProviderUnique implements Rule
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
        return !Provider::where('rut', '=', $rut[0])->first();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Rut ya está registrado.';
    }
}
