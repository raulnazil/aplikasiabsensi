<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index() {
        $jadwals = Jadwal::all();
        return view('pages.jadwals.index', ["jadwals" => $jadwals,]);
    }

    public function dashboard() {
        return view('pages.jadwals.dashboard');
    }

    public function create() {
        $jadwals = Jadwal::all();
        return view('pages.jadwals.create', ["jadwals" => $jadwals,]);
    }

    public function store(Request $request) {

        Jadwal::create([
            "user_id" => $request->input('user_id'),
            "bulan"   => $request->input('bulan'),
            "tanggal" => $request->input('tanggal'),
            "shift"   => $request->input('shift'),
            "jam"     => $request->input('jam'), // simpan waktu yang diformat dengan benar
            "posisi"  => $request->input('posisi'),
        ]);

        Alert::success('Berhasil!', 'Data jadwal berhasil disimpan.');
        return redirect('/jadwals');
    }

    public function edit($id) {
        // Ambil data jadwal berdasarkan ID
        $jadwals = Jadwal::findOrFail($id);

        // Kirim data ke view
        return view('pages.jadwals.edit', ["jadwal" => $jadwals]);
    }

    public function update(Request $request, $id) {
        // Validasi data
        $request->validate([
            "user_id" => 'required|exists:users,id', // Pastikan `user_id` valid di tabel users
            "bulan"   => 'required|date',
            "tanggal" => 'required|date',
            "shift"   => 'required|string',
            "jam"     => 'required|date_format:H:i', // menggunakan format H:i:s
            "posisi"  => 'required|string',
        ]);

        // Temukan data absensi berdasarkan ID
        $Jadwal = Jadwal::findOrFail($id);


        // Update data absensi
        $Jadwal->update([
            "user_id" => $request->input('user_id'),
            "bulan"   => $request->input('bulan'),
            "tanggal" => $request->input('tanggal'),
            "shift"   => $request->input('shift'),
            "jam"     => $request->input('jam'),
            "posisi"  => $request->input('posisi'),
        ]);


        Alert::success('Berhasil!', 'Data jadwal berhasil diperbarui.');
        // Redirect ke halaman jadwals dengan pesan sukses
        return redirect('/jadwals');
    }




    public function delete($id) {
        $jadwals = Jadwal::findOrFail($id);
        $jadwals->delete();
        Alert::success('Berhasil!', 'Data jadwal berhasil dihapus.');
        return redirect('/jadwals');
    }
}



