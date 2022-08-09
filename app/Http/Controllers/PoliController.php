<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PoliController extends Controller
{
    public function index()
    {
        $poli = DB::table('master_unit')->get();
        return view('poli.poli', ['poli' => $poli]);
    }

    public function add(Request $request)
    {
        $unit_kode = $request->unit_kode;
        $unit_nama = $request->unit_nama;
        $unit_id = DB::table('master_unit')->select('unit_id')->orderBy('unit_id', 'desc')->first()->unit_id;
        $unit_id = ++$unit_id;
        $addData = DB::table('master_unit')->insert([
            'unit_id' => $unit_id,
            'unit_kode' => $unit_kode,
            'unit_nama' => $unit_nama
        ]);
        return redirect()->route('poli.index')->with('alert-success', "Penambahan Data Poli Berhasil");
    }

    public function edit(Request $request)
    {
        $unit_id = $request->unit_id;
        $unit_kode = $request->unit_kode;
        $unit_nama = $request->unit_nama;
        $updateData = DB::table('master_unit')->where('unit_id', $unit_id)->update([
            'unit_kode' => $unit_kode,
            'unit_nama' => $unit_nama
        ]);
        return redirect()->route('poli.index')->with('alert-success', "Pengubahan Data Poli Berhasil");
    }

    public function delete(Request $request)
    {
        $unit_id = $request->unit_id;
        $deleteData = DB::table('master_unit')->where('unit_id', $unit_id)->delete();
        return redirect()->route('poli.index')->with('alert-success', "Penghapusan Data Poli Berhasil");
    }
}
