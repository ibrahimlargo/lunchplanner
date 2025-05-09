<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MustBeCheck24EmailRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valueArray = explode('@', $value);

        $endValue = end($valueArray)[0];
        if( $endValue !== 'check24.de' ||  count($valueArray) !== 2 ) {
            $fail('Dies ist keine Check24 Email.');
        }
    }
}
