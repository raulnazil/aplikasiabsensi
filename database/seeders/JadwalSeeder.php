<?php

namespace Database\Seeders;

use App\Models\Jadwal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Jadwal::create([
            "user_id" => "1",
            "bulan"   => "2024-11-20",
            "tanggal" => "2024-09-10",
            "shift"   => "sore",
            "jam"     => "20:00",
            "posisi"  => "it",
        ]);
    }
}
