<?php

namespace Database\Seeders;

use App\Models\RincianGaji;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RincianGajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RincianGaji::create([
         "user_id"     => "1",
         "bulan"       => "11",
         "tahun"       => "2003",
         "gaji_pokok"  =>  "4500.000",
         "tunjangan_paket_internet" => "50.000",
         "tunjangan_transportasi" => "300.000",
         "tunjangan_bpjs" => "200.000",
         "tunjangan_uang_makan" => "25.000",
         "total_penghasilan_bruto" => "5075.000",
         "jaminan_hari_tua"        => "100.000",
         "jaminan_pensiun"         => "50.000",
         "total_bruto"          => "150.000",
         "total_diterima"       => "4925.000",
        ]);
    }
}
