<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $absensi = Absensi::all();

        return response()->json($absensi, 200);
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
            'jam'     => 'required|date_format:H:i',
            'posisi'  => 'required|string',
        ]);

        $absensi = Absensi::create([
            'user_id' => $request->user_id,
            'bulan'   => $request->bulan,
            'tanggal' => $request->tanggal,
            'shift'   => $request->shift,
            'jam'     => $request->jam,
            'posisi'  => $request->posisi,
        ]);

        $absensi = Absensi::create($request->all());
        return response()->json($absensi, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $absensi = Absensi::findOrFail($id);
        return response()->json($absensi, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'bulan'   => 'required|date',
            'tanggal' => 'required|date',
            'shift'   => 'required|string',
            'jam'     => 'required|date_format:H:i',
            'posisi'  => 'required|string',
        ]);

        $absensi->update($request->all());
        return response()->json($absensi, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();
        return response()->json(null, 204);
    }
}
