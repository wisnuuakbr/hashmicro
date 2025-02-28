<?php

namespace Database\Seeders;

use App\Models\CharacterMatch;
use App\Models\User;
use Illuminate\Database\Seeder;

class CharacterMatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        // Contoh data untuk pengecekan karakter
        $samples = [
            [
                'first_input' => 'ABBCD',
                'second_input' => 'Gallant Duck',
                'match_percentage' => 40.00, // A dan D cocok (2/5 = 40%)
            ],
            [
                'first_input' => 'HELLO',
                'second_input' => 'Hello World',
                'match_percentage' => 80.00, // H, E, L, L cocok (4/5 = 80%)
            ],
            [
                'first_input' => 'PROGRAMMING',
                'second_input' => 'I love coding and programming',
                'match_percentage' => 45.45, // P, R, O, G, A cocok (5/11 = 45.45%)
            ],
            [
                'first_input' => 'TESTING',
                'second_input' => 'Unit tests are important',
                'match_percentage' => 42.86, // T, E, S, T cocok (4/7 = 57.14%)
            ],
            [
                'first_input' => 'PHP',
                'second_input' => 'Laravel is a PHP framework',
                'match_percentage' => 100.00, // P, H, P cocok (3/3 = 100%)
            ],
        ];

        foreach ($users as $user) {
            foreach ($samples as $sample) {
                CharacterMatch::create([
                    'first_input' => $sample['first_input'],
                    'second_input' => $sample['second_input'],
                    'match_percentage' => $sample['match_percentage'],
                    'user_id' => $user->id,
                    'created_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}
