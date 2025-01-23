<?php

namespace App\Http\Controllers;

use App\Models\RincianGaji;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class RincianGajiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

      public function generatePDF(Request $request)
      {
       $rinciangaji =  RincianGaji::with('posisi')
                                    ->where('user_id', $request->user_id)
                                    ->where('bulan', $request->bulan)
                                    ->where('tahun', $request->tahun)
                                    ->first();

        $rinciangaji = RincianGaji::all();
        $pdf = PDF::loadView('rincian-gaji/rincian_gaji_pdf', compact('rinciangaji'));
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('rincian_gaji.pdf');



    }

    public function hitungtotal(Request $request)
    {
        $validated = $request->validate([
            'gaji_pokok' => 'required|numeric',
            'tunjangan_paket_internet' => 'required|numeric',
            'tunjangan_transportasi'   => 'required|numeric',
            'tunjangan_bpjs'           => 'required|numeric',
            'tunjangan_uang_makan'     => 'required|numeric',
        ]);

        // Hitung total penghasilan bruto
    $total_penghasilan_bruto =
    $validated['gaji_pokok'] +
    $validated['tunjangan_paket_internet'] +
    $validated['tunjangan_transportasi'] +
    $validated['tunjangan_bpjs'] +
    $validated['tunjangan_uang_makan'];

     // Format angka menggunakan number_format
     return response()->json([
        'gaji_pokok' => number_format($validated['gaji_pokok'], 0, ',', '.'),
        'tunjangan_paket_internet' => number_format($validated['tunjangan_paket_internet'], 0, ',', '.'),
        'tunjangan_transportasi' => number_format($validated['tunjangan_transportasi'], 0, ',', '.'),
        'tunjangan_bpjs' => number_format($validated['tunjangan_bpjs'], 0, ',', '.'),
        'tunjangan_uang_makan' => number_format($validated['tunjangan_uang_makan'], 0, ',', '.'),
        'total_penghasilan_bruto' => number_format($total_penghasilan_bruto, 0, ',', '.'),
     ]);
    }


      public function calculate(Request $request)
      {
         $gaji_pokok = (float)$request->input('gaji_pokok');
         $tunjangan_paket_internet = (float)$request->input('tunjangan_paket_internet');
         $tunjangan_transportasi  = (float)$request->input('tunjangan_transportasi');
         $tunjangan_bpjs = (float)$request->input('tunjangan_bpjs');
         $tunjangan_uang_makan = (float)$request->input('tunjangan_uang_makan');

         // menghitung total penghasilan bruto
         $total_penghasilan_bruto = $gaji_pokok + $tunjangan_paket_internet + $tunjangan_transportasi + $tunjangan_bpjs + $tunjangan_uang_makan;

         // mengembalikan hasil perhitungan dalam format JSON
         return response()->json([
            'id' => $request->input('id'),
            'user_id' => $request->input('user_id'),
            'bulan'   => $request->input('bulan'),
            'tahun'   => $request->input('tahun'),
            'total_penghasilan_bruto' => number_format($total_penghasilan_bruto, 4),
         ]);
      }

    public function index()
    {
        $rinciangaji = RincianGaji::all();
        return response()->json($rinciangaji, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'user_id'                  => 'required|exists:users,id',
            'bulan'                    => 'required|integer|min:1|max:12',
            'tahun'                    => 'required|integer|min:1900|max:' . date('Y'),
            'gaji_pokok'               => 'required|numeric',
            'tunjangan_paket_internet' => 'required|numeric',
            'tunjangan_transportasi'   => 'required|numeric',
            'tunjangan_bpjs'           => 'required|numeric',
            'tunjangan_uang_makan'     => 'required|numeric',
            'jaminan_hari_tua'        => 'required|numeric',
            'jaminan_pensiun'         => 'required|numeric',
        ]);

      // Hitung total penghasilan bruto
    $total_penghasilan_bruto =
    $validated['gaji_pokok'] +
    $validated['tunjangan_paket_internet'] +
    $validated['tunjangan_transportasi'] +
    $validated['tunjangan_bpjs'] +
    $validated['tunjangan_uang_makan'];

    $total_bruto =
    $validated['jaminan_hari_tua'] +
    $validated['jaminan_pensiun'];


    $total_diterima = $total_penghasilan_bruto - $total_bruto;
    $validated['total_diterima'] = $total_diterima;

    // Simpan data ke dalam database
    $rinciangaji = new Rinciangaji();
    $rinciangaji->user_id = $validated['user_id'];
    $rinciangaji->bulan = $validated['bulan'];
    $rinciangaji->tahun = $validated['tahun'];
    $rinciangaji->gaji_pokok = $validated['gaji_pokok'];
    $rinciangaji->tunjangan_paket_internet = $validated['tunjangan_paket_internet'];
    $rinciangaji->tunjangan_transportasi = $validated['tunjangan_transportasi'];
    $rinciangaji->tunjangan_bpjs = $validated['tunjangan_bpjs'];
    $rinciangaji->tunjangan_uang_makan = $validated['tunjangan_uang_makan'];
    $rinciangaji->jaminan_hari_tua = $validated['jaminan_hari_tua'];
    $rinciangaji->jaminan_pensiun = $validated['jaminan_pensiun'];
    $rinciangaji->total_penghasilan_bruto = $total_penghasilan_bruto;
    $rinciangaji->total_bruto = $total_bruto;
    $rinciangaji->total_diterima = $total_diterima;
    $rinciangaji->save();
     // Format angka menggunakan number_format
     return response()->json([
        'user_id'    => $rinciangaji-> user_id,
        'bulan'      => $rinciangaji-> bulan,
        'tahun'      => $rinciangaji->tahun,
        'gaji_pokok' => number_format($rinciangaji->gaji_pokok, 0, ',', '.'),
        'tunjangan_paket_internet' => number_format($rinciangaji->tunjangan_paket_internet, 0, ',', '.'),
        'tunjangan_transportasi' => number_format($rinciangaji->tunjangan_transportasi, 0, ',', '.'),
        'tunjangan_bpjs' => number_format($rinciangaji->tunjangan_bpjs, 0, ',', '.'),
        'tunjangan_uang_makan' => number_format($rinciangaji->tunjangan_uang_makan, 0, ',', '.'),
        'jaminan_hari_tua'     => number_format($rinciangaji->jaminan_hari_tua, 0, ',', '.'),
        'jaminan_pensiun'      => number_format($rinciangaji->jaminan_pensiun, 0, ',', '.'),
        'total_penghasilan_bruto' => number_format($rinciangaji->$total_penghasilan_bruto, 0, ',', '.'),
        'total_bruto' => number_format($rinciangaji->$total_bruto, 0, ',', '.'),
        'total_diterima' => number_format($rinciangaji->$total_diterima, 0, ',', '.'),
     ]);

        $rinciangaji = RincianGaji::create([
            'user_id'     => $request->user_id,
            'bulan'       => $request->bulan,
            'tahun'       => $request->tahun,
            'gaji_pokok'  => $request->gaji_pokok,
            'tunjangan_paket_internet' => $request->tunjangan_paket_internet,
            'tunjangan_transportasi'   => $request->tunjangan_transportasi,
            'tunjangan_bpjs'           => $request->tunjangan_bpjs,
            'tunjangan_uang_makan'     => $request->tunjangan_uang_makan,
            'jaminan_hari_tua'         => $request->jaminan_hari_tua,
            'jaminan_pensiun'          => $request->jaminan_pensiun,
            'total_penghasilan_bruto'  => $total_penghasilan_bruto,
            'total_bruto'              => $total_bruto,
            'total_diterima'           => $total_diterima,
        ]);

        // menggunakan query builder untuk menambahkan data
        $rinciangaji = DB::table('rincian_gajis')->insert([
            'user_id' => $validated['user_id'],
            'bulan'   => $validated['bulan'],
            'tahun'   => $validated['tahun'],
            'gaji_pokok' => $validated['gaji_pokok'],
            'tunjangan_paket_internet' => $validated['tunjangan_paket_internet'],
            'tunjangan_transportasi'   => $validated['tunjangan_transportasi'],
            'tunjangan_bpjs' => $validated['tunjangan_bpjs'],
            'tunjangan_uang_makan' => $validated['tunjangan_uang_makan'],
            'jaminan_hari_tua'     => $validated['jaminan_hari_tua'],
            'jaminan_pensiun'      => $validated['jaminan_pensiun'],
            'total_penghasilan_bruto' => $validated['total_penghasilan_bruto'],
            'total_bruto'  => $total_bruto,
            'total_diterima' => $total_diterima,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $rinciangaji = DB::table('rincian_gajis')->where('id', $rinciangaji)->first();

        $rinciangaji = RincianGaji::create($request->all());
        return response()->json($rinciangaji, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
       $rinciangaji = RincianGaji::findOrFail($id);
       return response()->json($rinciangaji, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rinciangaji = RincianGaji::findOrFail($id);

           $validated   =   $request->validate([
            'user_id'                  => 'required|exists:users,id',
            'bulan'                    => 'required|integer|min:1|max:12',
            'tahun'                    => 'required|integer|min:1900|max:' . date('Y'),
            'gaji_pokok'               => 'required|numeric',
            'tunjangan_paket_internet' => 'required|numeric',
            'tunjangan_transportasi'   => 'required|numeric',
            'tunjangan_bpjs'           => 'required|numeric',
            'tunjangan_uang_makan'     => 'required|numeric',
            'jaminan_hari_tua'         => 'required|numeric',
            'jaminan_pensiun'          => 'required|numeric',
          ]);

     $total_penghasilan_bruto =
     $validated['gaji_pokok'] +
     $validated['tunjangan_paket_internet'] +
     $validated['tunjangan_transportasi'] +
     $validated['tunjangan_bpjs'] +
     $validated['tunjangan_uang_makan'];
     $validated['total_penghasilan_bruto'] = $total_penghasilan_bruto;

     $total_bruto =
     $validated['jaminan_hari_tua'] +
     $validated['jaminan_pensiun'];
     $validated['total_bruto'] = $total_bruto;

     $total_diterima = $total_penghasilan_bruto - $total_bruto;
     $validated['total_diterima'] = $total_diterima;

     // Update data ke database
     $rinciangaji->update($validated);

     // Format angka menggunakan number_format
     return response()->json([
        'user_id'    => $rinciangaji-> user_id,
        'bulan'      => $rinciangaji-> bulan,
        'tahun'      => $rinciangaji->tahun,
        'gaji_pokok' => number_format($rinciangaji->gaji_pokok, 0, ',', '.'),
        'tunjangan_paket_internet' => number_format($rinciangaji->tunjangan_paket_internet, 0, ',', '.'),
        'tunjangan_transportasi' => number_format($rinciangaji->tunjangan_transportasi, 0, ',', '.'),
        'tunjangan_bpjs' => number_format($rinciangaji->tunjangan_bpjs, 0, ',', '.'),
        'tunjangan_uang_makan' => number_format($rinciangaji->tunjangan_uang_makan, 0, ',', '.'),
        'jaminan_hari_tua'     => number_format($rinciangaji->jaminan_hari_tua, 0, ',', '.'),
        'jaminan_pensiun'      => number_format($rinciangaji->jaminan_pensiun, 0, ',', '.'),
        'total_penghasilan_bruto' => number_format($rinciangaji->$total_penghasilan_bruto, 0, ',', '.'),
        'total_bruto' => number_format($rinciangaji->$total_bruto, 0, ',', '.'),
        'total_diterima' => number_format($rinciangaji->$total_diterima, 0, ',', '.'),
        ]);

        // Menggunakan query builder untuk memperbarui data
        DB::table('rincian_gajis')->where('id', $id)->update([
            'user_id' => $validated['user_id'],
            'bulan'   => $validated['bulan'],
            'tahun'   => $validated['tahun'],
            'gaji_pokok' => $validated['gaji_pokok'],
            'tunjangan_paket_internet' => $validated['tunjangan_paket_internet'],
            'tunjangan_transportasi'   => $validated['tunjangan_transportasi'],
            'tunjangan_bpjs' => $validated['tunjangan_bpjs'],
            'tunjangan_uang_makan' => $validated['tunjangan_uang_makan'],
            'jaminan_hari_tua'  => $validated['jaminan_hari_tua'],
            'jaminan_Pensiun'   => $validated['jaminan_pensiun'],
            'total_penghasilan_bruto' => $total_penghasilan_bruto,
            'total_bruto' => $total_bruto,
            'total_diterima' => $total_diterima,
            'updated_at' => now(),
        ]);

        $rinciangaji = DB::table('rincian_gajis')->where('id', $id)->first();

        $rinciangaji->update($request->all());
        return response()->json($rinciangaji, 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rinciangaji = RincianGaji::findOrFail($id);
        $rinciangaji->delete();
        return response()->json(null, 204);
    }
}
