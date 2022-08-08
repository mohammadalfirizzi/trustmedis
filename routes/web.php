<?php

use App\Http\Controllers\PegawaiController;
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

Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::post('/pegawai/add', [PegawaiController::class, 'add'])->name('pegawai.add');
Route::post('/pegawai/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::post('/pegawai/delete', [PegawaiController::class, 'delete'])->name('pegawai.delete');
