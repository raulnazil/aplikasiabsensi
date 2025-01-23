<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RincianGaji extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','bulan','tahun','gaji_pokok','tunjangan_paket_internet','tunjangan_transportasi','tunjangan_bpjs','tunjangan_uang_makan','total_penghasilan_bruto','jaminan_hari_tua','jaminan_pensiun','total_bruto','total_diterima'];

    public function posisi()
    {
        return $this->belongsTo(Posisi::class, 'nama_posisi');
    }
}
