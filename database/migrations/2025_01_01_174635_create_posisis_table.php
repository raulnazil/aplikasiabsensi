<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posisis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_posisi');
            $table->decimal('gaji_pokok', 15, 3);
            $table->decimal('tunjangan_jabatan', 15, 3);
            $table->decimal('tunjangan_paket_internet', 15, 3);
            $table->decimal('tunjangan_transportasi', 15, 3);
            $table->decimal('tunjangan_bpjs', 15, 3);
            $table->decimal('tunjangan_uang_makan', 15, 3);
            $table->decimal('uang_lembur_perjam', 15, 3)->default(0);
            $table->decimal('jam_lembur', 15, 3)->default(0);
            $table->decimal('pengurangan_izin', 15, 3)->default(0);
            $table->decimal('pengurangan_keterlambatan', 15, 3)->default(0);
            $table->decimal('total_gaji', 15, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posisis');
    }
};
