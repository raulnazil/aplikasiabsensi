<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AbsensiController extends Controller
{
    public function index() {
        $absensis = Absensi::with('absensis')->get();
        return view('pages.absensis.index', ["absensis" => $absensis,]);
    }

    public function dashboard() {
        return view('pages.absensis.dashboard');
    }

    public function create() {
        $absensis = Absensi::all();
        return view('pages.absensis.create', ["absensis" => $absensis,]);
    }

    public function store(Request $request) {

        Absensi::create([
            "user_id" => $request->input('user_id'),
            "bulan"   => $request->input('bulan'),
            "tanggal" => $request->input('tanggal'),
            "shift"   => $request->input('shift'),
            "jam"     => $request->input('jam'),
            "posisi"  => $request->input('posisi'),
        ]);

        return redirect('/absensis');
    }

    public function edit($id) {
        // Ambil data absensi berdasarkan ID
        $absensi = Absensi::findOrFail($id);

        // Kirim data ke view
        return view('pages.absensis.edit', ["absensi" => $absensi]);
    }

    public function update(Request $request, $id) {
        // Validasi data
        $request->validate([
            "user_id" => 'required|exists:users,id', // Pastikan `user_id` valid di tabel users
            "bulan"   => 'required|date',
            "tanggal" => 'required|date',
            "shift"   => 'required|string',
            "jam"     => 'required|date_format:H:i',
            "posisi"  => 'required|string',
        ]);

        // Temukan data absensi berdasarkan ID
        $absensi = Absensi::findOrFail($id);

        // Update data absensi
        $absensi->update([
            "user_id" => $request->input('user_id'),
            "bulan"   => $request->input('bulan'),
            "tanggal" => $request->input('tanggal'),
            "shift"   => $request->input('shift'),
            "jam"     => $request->input('jam'),
            "posisi"  => $request->input('posisi'),
        ]);

        // Redirect ke halaman absensis dengan pesan sukses
        return redirect('/absensis')->with('success', 'Data absensi berhasil diperbarui.');
    }




    public function delete($id) {
        $absensis = Absensi::findOrFail($id);
        $absensis->delete();

        return redirect('/absensis');
    }
}



