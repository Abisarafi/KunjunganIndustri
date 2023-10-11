<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ParticipantCountRule implements Rule
{
    public function passes($attribute, $value)
    {
        $class = request()->input('class');

        // Define the maximum participant counts for each class
        $maxCounts = [
            'TKJ' => 2,
            'SIJA' => 2,
            'TJA' => 2,
            'MM' => 1,
            'RPL' => 1,
            'Broadcasting' => 1,
        ];

        // Check if the selected class exceeds the maximum count
        return $value <= $maxCounts[$class];
    }

    public function message()
    {
        return 'The selected class exceeds the maximum participant count.';
    }
}
