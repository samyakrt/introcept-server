<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidPhoneNumber implements Rule
{
    const VALID_NUMBERS = [
        984,
        985,
        986,
        974,
        975,
        980,
        981,
        982,
        961,
        962,
        988,
        972,
        963
    ];

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $first_three_numbers = substr($value, 0, 3);
        if (in_array($first_three_numbers, self::VALID_NUMBERS)) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Phone Number.';
    }
}
