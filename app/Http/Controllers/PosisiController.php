<?php

namespace App\Http\Controllers;

use App\Models\Posisi;
use Illuminate\Http\Request;

class PosisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posisis = Posisi::all();
        return response()->json($posisis);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validateData =  $request->validate([
            'nama_posisi' => 'required|string|max:255',
            'gaji_pokok'  => 'required|numeric',
            'tunjangan_jabatan' => 'required|numeric',
            'tunjangan_paket_internet' => 'required|numeric',
            'tunjangan_transportasi'  => 'required|numeric',
            'tunjangan_bpjs' => 'required|numeric',
            'tunjangan_uang_makan' => 'required|numeric',
            'uang_lembur_perjam' => 'required|numeric',
            'jam_lembur'         => 'required|numeric',
            'pengurangan_izin'   => 'required|numeric',
            'pengurangan_keterlambatan' => 'required|numeric',
        ]);

   $total_gaji = 0;
// Periksa apakah ada jam lembur atau tidak
if ($validateData['jam_lembur'] > 0) {
    // Hitung uang lembur jika ada jam lembur
    $uang_lembur_perjam = $validateData['uang_lembur_perjam'] *$validateData['jam_lembur'];
    $total_gaji += $uang_lembur_perjam; // Tambahkan uang lembur ke total gaji

  }else {
    // jika tidak ada jam lembur, pastikan uang lembur = 0
    $uang_lembur_perjam = 0;
  }



        // Perhitungan total_gaji
        $total_gaji = $validateData['gaji_pokok']
                      + $validateData['tunjangan_jabatan']
                      + $validateData['tunjangan_paket_internet']
                      + $validateData['tunjangan_transportasi']
                      + $validateData['tunjangan_bpjs']
                      + $validateData['tunjangan_uang_makan']
                      + $uang_lembur_perjam;


        // potongan
        $total_gaji -= $validateData['pengurangan_izin'];
        $total_gaji -= $validateData['pengurangan_keterlambatan'];

        // tambah data
        $validateData['total_gaji'] = $total_gaji;


        $posisi = Posisi::create($validateData);
        return response()->json($posisi, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $posisi = Posisi::find($id);
        return response()->json($posisi, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $posisi = Posisi::find($id);

        $validateData = $request->validate([
            'nama_posisi' => 'required|string|max:255',
            'gaji_pokok'  => 'required|numeric',
            'tunjangan_jabatan' => 'required|numeric',
            'tunjangan_paket_internet' => 'required|numeric',
            'tunjangan_transportasi'  => 'required|numeric',
            'tunjangan_bpjs' => 'required|numeric',
            'tunjangan_uang_makan' => 'required|numeric',
            'uang_lembur_perjam' => 'required|numeric',
            'uang_lembur'  => 'required|numeric',
            'pengurangan_izin'   => 'required|numeric',
            'pengurangan_keterlambatan' => 'required|numeric',
        ]);

        // Perhitungan total_gaji
        $total_gaji = $validateData['gaji_pokok']
                      +$validateData['tunjangan_jabatan']
                      +$validateData['tunjangan_paket_internet']
                      +$validateData['tunjangan_transportasi']
                      +$validateData['tunjangan_bpjs']
                      +$validateData['tunjangan_uang_makan'];

        // Misal uang lembur dihitung berdasarkan jam lembur
        if ($request->has('jam_lembur')) {
            $total_gaji += $validateData['uang_lembur_perjam'] *$request->input('jam_lembur');
        }

        // Potongan
        $total_gaji -= $validateData['pengurangan_izin'];
        $total_gaji -= $validateData['pengurangan_keterlambatan'];

        $validateData['total_gaji'] = $total_gaji;

        $posisi->update($validateData);
        return response($posisi, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $posisi = Posisi::find($id);
        $posisi->delete();
        return response()->json(null, 204);
    }
}
