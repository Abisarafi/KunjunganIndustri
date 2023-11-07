<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;

class NotToday implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
    }
        //validasi untuk tidak bisa memilih hari ini

    public function passes($attribute, $value)
    {
        $date = Carbon::parse($value);
        return !$date->isSameDay(Carbon::today());
    }

    public function message()
    {
        return 'Anda tidak boleh memilih tanggal hari ini.';
    }
}
