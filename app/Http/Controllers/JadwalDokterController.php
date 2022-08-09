<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalDokterController extends Controller
{
    public function index()
    {
        $hari = DB::table('master_hari')->get();
        // DB::enableQueryLog();
        $jadwalFull = DB::table('master_jadwal_dokter')
            ->join('master_hari', 'master_jadwal_dokter.jadwal_hari_id', '=', 'master_hari.hari_id')
            ->join('master_dokter', 'master_jadwal_dokter.jadwal_dokter_id', '=', 'master_dokter.pegawai_id')
            ->join('master_unit', 'master_jadwal_dokter.jadwal_unit_id', '=', 'master_unit.unit_id')
            ->get();
        $jadwal = DB::table('master_jadwal_dokter')
            ->rightJoin('master_hari', 'master_jadwal_dokter.jadwal_hari_id', '=', 'master_hari.hari_id')
            ->leftJoin('master_dokter', 'master_jadwal_dokter.jadwal_dokter_id', '=', 'master_dokter.pegawai_id')
            ->leftJoin('master_unit', 'master_jadwal_dokter.jadwal_unit_id', '=', 'master_unit.unit_id')
            // ->select('master_dokter.pegawai_nama', 'master_unit.unit_nama', 'master_jadwal_dokter.jadwal_hari_id', 'master_hari.hari_nama', 'master_jadwal_dokter.jadwal_mulai', 'master_jadwal_dokter.jadwal_selesai')
            // ->groupBy('jadwal_unit_id')
            ->get();

        $dokter = DB::table('master_dokter')->get();

        $poli = DB::table('master_unit')->get();
        return view('jadwal.jadwal', ['hari' => $hari, 'jadwal' => $jadwal, 'dokter' => $dokter, 'poli' => $poli, 'jadwalFull' => $jadwalFull]);
    }

    public function add(Request $request)
    {
        $last_id = DB::table('master_jadwal_dokter')->select('jadwal_id')->orderBy('jadwal_id', 'desc')->first()->jadwal_id;
        $last_id = ++$last_id;
        $jadwal = DB::table('master_jadwal_dokter')
            ->insert([
                'jadwal_id' => $last_id,
                'jadwal_dokter_id' => $request->jadwal_dokter_id,
                'jadwal_unit_id' => $request->jadwal_unit_id,
                'jadwal_hari_id' => $request->jadwal_hari_id,
                'jadwal_mulai' => $request->jadwal_mulai,
                'jadwal_selesai' => $request->jadwal_selesai
            ]);
        return redirect()->route('jadwal.index')->with('alert-success', 'Data berhasil ditambahkan');
    }

    public function edit(Request $request)
    {
        $jadwal_id = $request->jadwal_id;
        $jadwal = DB::table('master_jadwal_dokter')
            ->where('jadwal_id', $jadwal_id)
            ->update([
                'jadwal_dokter_id' => $request->jadwal_dokter_id,
                'jadwal_unit_id' => $request->jadwal_unit_id,
                'jadwal_hari_id' => $request->jadwal_hari_id,
                'jadwal_mulai' => $request->jadwal_mulai,
                'jadwal_selesai' => $request->jadwal_selesai
            ]);
        return redirect()->route('jadwal.index')->with('alert-success', 'Data berhasil diubah');
    }

    public function delete(Request $request)
    {
        $jadwal_id = $request->jadwal_id;
        $jadwal = DB::table('master_jadwal_dokter')
            ->where('jadwal_id', $jadwal_id)
            ->delete();
        return redirect()->route('jadwal.index')->with('alert-success', 'Data berhasil dihapus');
    }
}
