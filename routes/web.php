<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\JadwalController;
use App\Http\Controllers\Web\RincianGajiController;
use App\Models\Jadwal;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [AuthController::class, 'form'])->name('login');
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    // Route untuk halaman dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])
        ->name('dashboard');  // Menambahkan nama route untuk kemudahan akses

    // Anda bisa menambahkan route lain yang membutuhkan autentikasi di sini
});

Route::get('/dashboard', [JadwalController::class, 'dashboard']);

// Route::get('/absensis', [AbsensiController::class, 'index']);
Route::get('/jadwals/create', [JadwalController::class, 'create']);
// Route::get('/absensis/edit/{id}', [AbsensiController::class, 'edit']);
Route::post('/jadwals/store', [JadwalController::class, 'store']);
// Route::put('/absensis/{id}', [AbsensiController::class, 'update'])->name('update');
// Route::delete('/absensis/{id}', [AbsensiController::class, 'delete']);

Route::prefix('jadwals')->group(function () {
    Route::get('/', [JadwalController::class, 'index'])->name('jadwals.index');
    Route::get('/create', [JadwalController::class, 'create'])->name('jadwals.create');
    Route::post('/', [JadwalController::class, 'store'])->name('jadwals.store');
    Route::get('/edit/{id}', [JadwalController::class, 'edit'])->name('jadwals.edit');
    Route::put('/update/{id}', [JadwalController::class, 'update'])->name('jadwals.update');
    Route::delete('/{id}', [JadwalController::class, 'delete'])->name('jadwals.delete');
});

Route::prefix('rinciangajis')->group(function () {
    Route::get('/', [RincianGajiController::class, 'index'])->name('rinciangajis.index');
    Route::get('/dashboard', [RincianGajiController::class, 'dashboard']);
    Route::get('/create', [RincianGajiController::class, 'create'])->name('rinciangajis.create');
    Route::post('/store', [RincianGajiController::class, 'store'])->name('rinciangajis.store');
    Route::get('/edit/{id}', [RincianGajiController::class, 'edit'])->name('rinciangajis.edit');
    Route::put('/update/{id}', [RincianGajiController::class, 'update'])->name('rinciangajis.update');
    Route::delete('/{id}', [RincianGajiController::class, 'delete'])->name('rinciangajis.delete');

    Route::get('/generate-pdf', [RincianGajiController::class, 'generatePDF'])->name('rincian_gaji.pdf');
});










