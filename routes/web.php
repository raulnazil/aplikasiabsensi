<?php

use App\Http\Controllers\Web\AbsensiController;
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

Route::get('/dashboard', [AbsensiController::class, 'dashboard']);

// Route::get('/absensis', [AbsensiController::class, 'index']);
Route::get('/absensis/create', [AbsensiController::class, 'create']);
// Route::get('/absensis/edit/{id}', [AbsensiController::class, 'edit']);
Route::post('/absensis/store', [AbsensiController::class, 'store']);
// Route::put('/absensis/{id}', [AbsensiController::class, 'update'])->name('update');
// Route::delete('/absensis/{id}', [AbsensiController::class, 'delete']);

Route::prefix('absensis')->group(function () {
    Route::get('/', [AbsensiController::class, 'index'])->name('absensis.index');
    Route::get('/create', [AbsensiController::class, 'create'])->name('absensis.create');
    Route::post('/', [AbsensiController::class, 'store'])->name('absensis.store');
    Route::get('/edit/{id}', [AbsensiController::class, 'edit'])->name('absensis.edit');
    Route::put('/update/{id}', [AbsensiController::class, 'update'])->name('absensis.update');
    Route::delete('/{id}', [AbsensiController::class, 'delete'])->name('absensis.delete');
});










