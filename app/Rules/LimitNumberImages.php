<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class LimitNumberImages implements Rule
{

    protected $number;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($number = 0)
    {
        $this->number = $number;
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
        return count($value) <= config('constants.case_images')-$this->number;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'El número máximo de imágenes por caso es '.config('constants.case_images').'.';
    }
}
