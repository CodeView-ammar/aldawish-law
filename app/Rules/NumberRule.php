<?php

namespace Tasawk\Rules;

use Illuminate\Validation\Validator;
use Illuminate\Contracts\Validation\Rule;

class NumberRule implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        return  $value > 0;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return __("validation.it_must_be_an_integer_greater_than_zero");
    }
}
