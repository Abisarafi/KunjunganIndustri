<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Pengajuan;

class UniqueWeekRequest implements ValidationRule
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
        // Check if there's an accepted request for the chosen week
        $startOfWeek = \Carbon\Carbon::parse($value)->startOfWeek();
        $endOfWeek = \Carbon\Carbon::parse($value)->endOfWeek();

        $count = Pengajuan::where('status', 'accepted')
            ->whereBetween('requested_date', [$startOfWeek, $endOfWeek])
            ->count();

        return $count === 0;
    }

    public function message()
    {
        return 'A visit request has already been accepted for this week.';
    }
}
