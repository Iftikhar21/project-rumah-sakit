<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ✅ ini yang benar

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penyakit')->insert([
            ['namaPenyakit' => 'Infeksi Telinga', 'spesialisasi' => 'THT'],
            ['namaPenyakit' => 'Radang Tenggorokan', 'spesialisasi' => 'THT'],
            ['namaPenyakit' => 'Sinusitis', 'spesialisasi' => 'THT'],
            ['namaPenyakit' => 'Gagal Jantung', 'spesialisasi' => 'Jantung'],
            ['namaPenyakit' => 'Hipertensi', 'spesialisasi' => 'Jantung'],
            ['namaPenyakit' => 'Demam Berdarah', 'spesialisasi' => 'Anak'],
            ['namaPenyakit' => 'Campak', 'spesialisasi' => 'Anak'],
            ['namaPenyakit' => 'Katarak', 'spesialisasi' => 'Mata'],
        ]);
    }
}
