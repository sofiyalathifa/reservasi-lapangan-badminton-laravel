<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PelatihSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \Illuminate\Support\Facades\DB::table('pelatihs')->insert([
            [
                'nama_pelatih' => 'Coach Ardi',
                'spesialisasi' => 'Footwork & Singles',
                'target_level' => 'Advanced',
                'harga_per_sesi' => 150000,
                'rating' => 4.9,
                'deskripsi' => 'Fokus pada peningkatan kecepatan langkah dan teknik tunggal putra/putri.',
                'status_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_pelatih' => 'Coach Nabila',
                'spesialisasi' => 'Beginner Clinic',
                'target_level' => 'Beginner',
                'harga_per_sesi' => 100000,
                'rating' => 4.8,
                'deskripsi' => 'Latihan dasar genggaman raket, pukulan dasar, dan pengenalan lapangan untuk pemula.',
                'status_aktif' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}