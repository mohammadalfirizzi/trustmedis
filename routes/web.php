<?php

use App\Http\Controllers\JadwalDokterController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PoliController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('pegawai.index');
});

// Pegawai
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::post('/pegawai/add', [PegawaiController::class, 'add'])->name('pegawai.add');
Route::post('/pegawai/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::post('/pegawai/delete', [PegawaiController::class, 'delete'])->name('pegawai.delete');


// Poli
Route::get('/poli', [PoliController::class, 'index'])->name('poli.index');
Route::post('/poli/add', [PoliController::class, 'add'])->name('poli.add');
Route::post('/poli/edit', [PoliController::class, 'edit'])->name('poli.edit');
Route::post('/poli/delete', [PoliController::class, 'delete'])->name('poli.delete');

// Jadwal Dokter
Route::get('/jadwal', [JadwalDokterController::class, 'index'])->name('jadwal.index');
Route::post('/jadwal/add', [JadwalDokterController::class, 'add'])->name('jadwal.add');
Route::post('/jadwal/edit', [JadwalDokterController::class, 'edit'])->name('jadwal.edit');
Route::post('/jadwal/delete', [JadwalDokterController::class, 'delete'])->name('jadwal.delete');
