<?php
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PosisiController;
use App\Http\Controllers\RincianGajiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route Api Jadwal
Route::apiResource('jadwal', JadwalController::class);

// Route Api Rincian-Gaji
Route::apiResource('rincian-gaji', RincianGajiController::class);

// Route Api Posisi
Route::apiResource('posisi', PosisiController::class);

Route::get('/hitung-total', [RincianGajiController::class, 'hitungtotal']);
Route::post('/hitung-total', [RincianGajiController::class, 'hitungtotal']);
Route::get('/calculate', [RincianGajiController::class, 'calculate']);

Route::get('/generate-pdf', [RincianGajiController::class, 'generatePDF']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
