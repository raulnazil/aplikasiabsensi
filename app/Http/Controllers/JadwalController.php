<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwal = Jadwal::all();

        return response()->json($jadwal, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
           $request->validate([
            'user_id' => 'required|exists:users,id',
            'bulan'   => 'required|date',
            'tanggal' => 'required|date',
            'shift'   => 'required|string',
            'jam'     => 'required|date_format:H:i', // format waktu dengan detik
            'posisi'  => 'required|string',
        ]);

        $jadwal = Jadwal::create($request->all());
        return response()->json($jadwal, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        return response()->json($jadwal, 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bulan'   => 'required|date',
            'tanggal' => 'required|date',
            'shift'   => 'required|string',
            'jam'     => 'required|date_format:H:i', // format jam dengan detik
            'posisi'  => 'required|string',
        ]);

        $jadwal->update([
            'user_id' => $request->user_id,
            'bulan'   => $request->bulan,
            'tanggal' => $request->tanggal,
            'shift'   => $request->shift,
            'jam'     => $request->jam,
            'posisi'  => $request->posisi,
        ]);

        // update data menggunakan query builder
        $jadwal = DB::table('jadwals')->where('id', $id)->update([
            'user_id' => $request->user_id,
            'bulan'   => $request->bulan,
            'tanggal' => $request->tanggal,
            'shift'   => $request->shift,
            'jam'     => $request->jam,
            'posisi'  => $request->posisi,
            'updated_at' => now(),
        ]);

        $jadwal = DB::table('jadwals')->where('id', $id)->first();

        $jadwal = Jadwal::find($id);
        $jadwal->update($request->all());
        return response()->json($jadwal, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->delete();
        return response()->json(null, 204);
    }
}
