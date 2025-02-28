<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CharacterMatch extends BaseModel
{
    protected $fillable = ['first_input', 'second_input', 'match_percentage', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDispplayName()
    {
        return "Match #{$this->id}";
    }

    // Method for count match precentage
    public function calculateMatchPercentage($firstInput, $secondInput)
    {
        // if empty input, return 0
        if (empty($firstInput)) return 0;

        // Count unique character in the firsInput
        $uniqueChars = array_unique(str_split($firstInput));
        $totalUniqueChars = count($uniqueChars);

        // Counter for the match character
        $matchedChars = 0;

        // Check every unique chars from firstInput
        foreach ($uniqueChars as $char) {
            // If the character is in the second input, increment the counter
            if (stripos($secondInput, $char) !== false) {
                $matchedChars++;
            }
        }

        // Count precentage
        return ($matchedChars / $totalUniqueChars) * 100;
    }
}
