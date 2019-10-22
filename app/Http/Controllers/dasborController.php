<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dasborController extends Controller
{
    public function index()
    {
    	$progja=DB::table('progja')
            ->select('progja.*', 'tahun_anggaran.nama_tahun_anggaran', 'pegawai.nama_pegawai', 'anggota.keterangan_anggota')
            ->where('anggota.keterangan_anggota','=','ketua')
            ->join('tahun_anggaran', 'progja.id_tahun_anggaran', '=', 'tahun_anggaran.id_tahun_anggaran')
            ->join('anggota', 'progja.id_progja', '=', 'anggota.id_progja')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'anggota.id_pegawai')
            ->get();
        $laporan_progja=DB::table('laporan')
        ->orderBy('id_progja','desc')
        ->orderBy('tanggal_pelaksanaan','desc')
        ->get();
        // dd($laporan_progja);
            return view('dasbor', ['progja'=>$progja, 'laporan'=>$laporan_progja]);
    }
}
