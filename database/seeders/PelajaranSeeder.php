<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelajaranSeeder extends Seeder
{
    public function run()
    {
        DB::table('pelajaran')->insert([
            ['id' => 19, 'nama' => 'Matematika', 'kategori' => 'realistic', 'is_khusus' => 0],
            ['id' => 20, 'nama' => 'Fisika', 'kategori' => 'investigative', 'is_khusus' => 0],
            ['id' => 21, 'nama' => 'Seni', 'kategori' => 'artistic', 'is_khusus' => 0],
            ['id' => 22, 'nama' => 'Sosiologi', 'kategori' => 'social', 'is_khusus' => 0],
            ['id' => 23, 'nama' => 'Ekonomi', 'kategori' => 'enterprising', 'is_khusus' => 0],
            ['id' => 24, 'nama' => 'Administrasi', 'kategori' => 'conventional', 'is_khusus' => 0],
            ['id' => 25, 'nama' => 'Kimia', 'kategori' => 'realistic', 'is_khusus' => 0],
            ['id' => 26, 'nama' => 'Biologi', 'kategori' => 'investigative', 'is_khusus' => 0],
            ['id' => 27, 'nama' => 'Musik', 'kategori' => 'artistic', 'is_khusus' => 0],
            ['id' => 28, 'nama' => 'Antropologi', 'kategori' => 'social', 'is_khusus' => 0],
            ['id' => 29, 'nama' => 'Manajemen', 'kategori' => 'enterprising', 'is_khusus' => 0],
            ['id' => 30, 'nama' => 'Akuntansi', 'kategori' => 'conventional', 'is_khusus' => 0],
            ['id' => 36, 'nama' => 'Geografi', 'kategori' => 'realistic', 'is_khusus' => 0],
            ['id' => 37, 'nama' => 'Statistika', 'kategori' => 'investigative', 'is_khusus' => 0],
            ['id' => 38, 'nama' => 'Desain Grafis', 'kategori' => 'artistic', 'is_khusus' => 0],
            ['id' => 39, 'nama' => 'Psikologi', 'kategori' => 'social', 'is_khusus' => 0],
            ['id' => 40, 'nama' => 'Kewirausahaan', 'kategori' => 'enterprising', 'is_khusus' => 0],
            ['id' => 41, 'nama' => 'Administrasi Bisnis', 'kategori' => 'conventional', 'is_khusus' => 0],
            ['id' => 42, 'nama' => 'Teknik Mesin', 'kategori' => 'realistic', 'is_khusus' => 0],
            ['id' => 43, 'nama' => 'Teknik Sipil', 'kategori' => 'realistic', 'is_khusus' => 0],
            ['id' => 44, 'nama' => 'Astronomi', 'kategori' => 'investigative', 'is_khusus' => 0],
            ['id' => 45, 'nama' => 'Seni Lukis', 'kategori' => 'artistic', 'is_khusus' => 0],
            ['id' => 46, 'nama' => 'Hubungan Internasional', 'kategori' => 'social', 'is_khusus' => 0],
            ['id' => 47, 'nama' => 'Pemasaran', 'kategori' => 'enterprising', 'is_khusus' => 0],
        ]);
    }
}
