<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\RincianGaji;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
class RincianGajiController extends Controller
{
    public function generatePDF(Request $request)
    {

        $rinciangaji = RincianGaji::where('user_id', $request->user_id)
                                    ->where('bulan', $request->bulan)
                                    ->where('tahun', $request->tahun)
                                    ->first();
        $rinciangaji = RincianGaji::all();
        $pdf = PDF::loadView('rincian-gaji/rincian_gaji_pdf', compact('rinciangaji'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('rincian_gaji.pdf');
    }
    public function index()
    {
        $rinciangaji = RincianGaji::all();
        return view('pages.rinciangajis.index', ["rinciangaji" => $rinciangaji]);
    }
    public function dashboard()
    {
        return view('pages.rinciangajis.dashboard');
    }
    public function create()
    {
        $rinciangaji = RincianGaji::all();
        return view('pages.rinciangajis.create', ["rinciangaji" => $rinciangaji]);
    }
    public function store(Request $request) {
          // Hitung total penghasilan bruto dari input

          $total_penghasilan_bruto = $request->input('gaji_pokok') +
                                     $request->input('tunjangan_paket_internet') +
                                     $request->input('tunjangan_transportasi') +
                                     $request->input('tunjangan_bpjs') +
                                     $request->input('tunjangan_uang_makan');

        // Hitung total_bruto (jaminan_hari_tua + jaminan_pensiun)

        $total_bruto = $request->input('jaminan_hari_tua') +
                       $request->input('jaminan_pensiun');

        // Hitung total diterima
           $total_diterima = $total_penghasilan_bruto - $total_bruto;


        RincianGaji::create([
            "user_id" => $request->input('user_id'),
            "bulan"   => $request->input('bulan'),
            "tahun"   => $request->input('tahun'),
            "gaji_pokok" => $request->input('gaji_pokok'),
            "tunjangan_paket_internet" => $request->input('tunjangan_paket_internet'),
            "tunjangan_transportasi"   => $request->input('tunjangan_transportasi'),
            "tunjangan_bpjs"           => $request->input('tunjangan_bpjs'),
            "tunjangan_uang_makan"     => $request->input('tunjangan_uang_makan'),
            "jaminan_hari_tua"         => $request->input('jaminan_hari_tua'),
            "jaminan_pensiun"          => $request->input('jaminan_pensiun'),
            "total_penghasilan_bruto"  => $total_penghasilan_bruto,
            "total_bruto"              => $total_bruto,
            "total_diterima"           => $total_diterima,
        ]);


        Alert::success('Berhasil!', 'Data gaji berhasil di simpan.');
        return redirect()->route('rinciangajis.index');
    }

    public function edit($id) {
        $rinciangaji = RincianGaji::findOrFail($id);
        return view('pages.rinciangajis.edit', ["rinciangaji" => $rinciangaji]);
    }

    public function update(Request $request, $id) {
        $request->validate([
           "user_id"                  => 'required|exists:users,id',
            "bulan"                    => 'required|integer|min:1|max:12',
            "tahun"                    => 'required|integer|min:1900|max:' . date('Y'),
            "gaji_pokok"               => 'required|numeric',
            "tunjangan_paket_internet" => 'required|numeric',
            "tunjangan_transportasi"   => 'required|numeric',
            "tunjangan_bpjs"           => 'required|numeric',
            "tunjangan_uang_makan"     => 'required|numeric',
            "jaminan_hari_tua"         => 'required|numeric',
            "jaminan_pensiun"          => 'required|numeric',

        ]);

        // Temukan data berdasarkan ID
        $rinciangaji = RincianGaji::findOrFail($id);

        // Hitung total penghasilan bruto
        $total_penghasilan_bruto = $request->input('gaji_pokok') +
                                   $request->input('tunjangan_paket_internet') +
                                   $request->input('tunjangan_transportasi') +
                                   $request->input('tunjangan_bpjs') +
                                   $request->input('tunjangan_uang_makan');

        // Hitung total bruto
        $total_bruto = $request->input('jaminan_hari_tua') +
                       $request->input('jaminan_pensiun');

        // Hitung total diterima
        $total_diterima = $total_penghasilan_bruto - $total_bruto;

        // Perbarui di database
        $rinciangaji->update([
            "user_id" => $request->input('user_id'),
            "bulan"   => $request->input('bulan'),
            "tahun"   => $request->input('tahun'),
            "gaji_pokok" => $request->input('gaji_pokok'),
            "tunjangan_paket_internet" => $request->input('tunjangan_paket_internet'),
            "tunjangan_transportasi"   => $request->input('tunjangan_transportasi'),
            "tunjangan_bpjs"           => $request->input('tunjangan_bpjs'),
            "tunjangan_uang_makan"     => $request->input('tunjangan_uang_makan'),
            "jaminan_hari_tua"         => $request->input('jaminan_hari_tua'),
            "jaminan_pensiun"          => $request->input('jaminan_pensiun'),
            "total_penghasilan_bruto"  => $total_penghasilan_bruto,
            "total_bruto"              => $total_bruto,
            "total_diterima"           => $total_diterima,
        ]);

        Alert::success('Berhasil!', 'Data gaji berhasil di perbarui.');
        return redirect()->route('rinciangajis.index');
    }

    public function delete($id) {
        $rinciangaji = RincianGaji::findOrFail($id);
        $rinciangaji->delete();

        Alert::success('Berhasil!', 'Data gaji berhasil di hapus.');
        return redirect()->route('rinciangajis.index');
    }
}

