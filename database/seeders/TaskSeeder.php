<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            // Create task with status "pending"
            Task::create([
                'title' => 'Membuat Dokumentasi Aplikasi',
                'description' => 'Menyusun dokumentasi teknis dan user guide untuk aplikasi yang sedang dikembangkan.',
                'status' => 'pending',
                'user_id' => $user->id,
                'created_at' => now()->subDays(rand(1, 3)),
            ]);

            Task::create([
                'title' => 'Menganalisis Kebutuhan User',
                'description' => 'Melakukan interview dan mengumpulkan feedback dari user untuk memahami kebutuhan mereka. Setelah mengumpulkan feedback, lakukan analisis untuk mengidentifikasi pola dan tren yang dapat membantu Anda dalam pengambilan keputusan.',
                'status' => 'pending',
                'user_id' => $user->id,
                'created_at' => now()->subDays(rand(1, 5)),
            ]);

            // Create task with status "in_progress"
            Task::create([
                'title' => 'Mengembangkan Fitur Login',
                'description' => 'Implementasi sistem autentikasi dengan multi-role dan fitur lupa password.',
                'status' => 'in_progress',
                'user_id' => $user->id,
                'created_at' => now()->subDays(rand(5, 10)),
            ]);
            // Create task with status "in_progress" but "overdue"
            Task::create([
                'title' => 'Memperbaiki Bug Pada Dashboard',
                'description' => 'Memperbaiki beberapa issue pada tampilan dashboard yang tidak responsive pada perangkat mobile.',
                'status' => 'in_progress',
                'user_id' => $user->id,
                'created_at' => '2025-02-10 01:26:18',
            ]);

            // Create task with status "completed"
            Task::create([
                'title' => 'Setup Database',
                'description' => 'Membuat skema database dan relasi antar tabel sesuai desain yang sudah disetujui.',
                'status' => 'completed',
                'user_id' => $user->id,
                'created_at' => now()->subDays(rand(10, 15)),
            ]);

            Task::create([
                'title' => 'Deploy ke Staging Server',
                'description' => 'Melakukan deployment aplikasi ke server staging untuk pengujian lebih lanjut oleh tim QA.',
                'status' => 'completed',
                'user_id' => $user->id,
                'created_at' => now()->subDays(rand(7, 12)),
            ]);
        }
    }
}
