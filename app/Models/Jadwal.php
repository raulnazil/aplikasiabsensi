<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','bulan','tanggal','shift','jam','posisi'];

    public function jadwals() {
        return $this->belongsTo(Jadwal::class);
    }
}
