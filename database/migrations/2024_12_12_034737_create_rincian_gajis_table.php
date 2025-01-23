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
        Schema::create('rincian_gajis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->decimal('gaji_pokok', 15, 3);
            $table->decimal('tunjangan_paket_internet', 15, 3);
            $table->decimal('tunjangan_transportasi', 15, 3);
            $table->decimal('tunjangan_bpjs', 15, 3);
            $table->decimal('tunjangan_uang_makan', 15, 3);
            $table->decimal('total_penghasilan_bruto', 15, 3);
            $table->decimal('jaminan_hari_tua', 15, 3);
            $table->decimal('jaminan_pensiun', 15, 3);
            $table->decimal('total_bruto', 15, 3);
            $table->decimal('total_diterima', 15, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rincian_gajis');
    }
};
