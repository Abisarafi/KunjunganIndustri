<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Carbon;


class NotPastDateRule implements ValidationRule
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

    // validasi untuk tidak bisa memilih hari yang sudah lewat
    public function passes($attribute, $value)
        {
            $date = Carbon::parse($value);
            return $date >= Carbon::today();
        }

        public function message()
        {
            return 'Tanggal yang anda pilih sudah lewat.';
        }

}
