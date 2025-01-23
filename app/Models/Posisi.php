<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posisi extends Model
{
    use HasFactory;
    protected $fillable = ['nama_posisi', 'gaji_pokok', 'tunjangan_jabatan', 'tunjangan_paket_internet', 'tunjangan_transportasi', 'tunjangan_bpjs', 'tunjangan_uang_makan', 'uang_lembur_perjam', 'jam_lembur', 'pengurangan_izin', 'pengurangan_keterlambatan', 'total_gaji'];


}
