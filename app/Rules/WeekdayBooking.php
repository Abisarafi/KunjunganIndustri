<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class WeekdayBooking implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        
    }
    public function passes($attribute, $value)
    {
        // Check if the selected date (value) is a Saturday or Sunday (weekend)
        $dayOfWeek = date('N', strtotime($value));

        // Return false for weekends (Saturday or Sunday)
        return !in_array($dayOfWeek, [6, 7]);
    }

    public function message()
    {
        return 'You can only book on weekdays (Monday to Friday).';
    }
}
