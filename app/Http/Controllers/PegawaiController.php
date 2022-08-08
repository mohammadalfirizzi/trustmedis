<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = DB::table('master_dokter')->get();
        return view('pegawai.pegawai', ['pegawai' => $pegawai]);
    }

    public function add(Request $request)
    {
        $pegawai_nama = $request->pegawai_nama;
        $pegawai_jenis_kelamin = $request->pegawai_jenis_kelamin;
        $pegawai_sip = $request->pegawai_sip;

        $last_id = DB::table('master_dokter')->select('pegawai_id')->orderBy('pegawai_id', 'desc')->first()->pegawai_id;
        $last_id = ++$last_id;
        $pegawai_nomor =  sprintf("%04s", $last_id);

        $addData = DB::table('master_dokter')->insert([
            'pegawai_id' => $last_id,
            'pegawai_nomor' => $pegawai_nomor,
            'pegawai_nama' => $pegawai_nama,
            'pegawai_jenis_kelamin' => $pegawai_jenis_kelamin,
            'pegawai_sip' => $pegawai_sip
        ]);

        return redirect()->route('pegawai.index')->with('alert-success', "Penambahan Data Pegawai Berhasil");
    }

    public function edit(Request $request)
    {
        $pegawai_id = $request->pegawai_id;
        $pegawai_nama = $request->pegawai_nama;
        $pegawai_jenis_kelamin = $request->pegawai_jenis_kelamin;
        $pegawai_sip = $request->pegawai_sip;

        $updateData = DB::table('master_dokter')->where('pegawai_id', $pegawai_id)->update([
            'pegawai_nama' => $pegawai_nama,
            'pegawai_jenis_kelamin' => $pegawai_jenis_kelamin,
            'pegawai_sip' => $pegawai_sip
        ]);

        return redirect()->route('pegawai.index')->with('alert-success', "Pengubahan Data Pegawai Berhasil");
    }

    public function delete(Request $request)
    {
        $pegawai_id = $request->pegawai_id;
        $deleteData = DB::table('master_dokter')->where('pegawai_id', $pegawai_id)->delete();
        return redirect()->route('pegawai.index')->with('alert-success', "Penghapusan Data Pegawai Berhasil");
    }
}
