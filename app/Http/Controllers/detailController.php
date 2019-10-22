<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class detailController extends Controller
{
    public function index($id_progja)
    {
    	$progja=DB::table('progja')
        ->where('progja.id_progja','=',$id_progja)
        ->join('tahun_anggaran', 'progja.id_tahun_anggaran', '=', 'tahun_anggaran.id_tahun_anggaran')
        ->get();

        $anggota=DB::table('anggota')
            ->select('anggota.*', 'pegawai.nama_pegawai')
            ->where('anggota.id_progja','=',$id_progja)
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'anggota.id_pegawai')
            ->get();
            
        $laporan_progja=DB::table('laporan')
        ->where('laporan.id_progja','=',$id_progja)
        ->orderBy('tanggal_pelaksanaan','desc')
        ->get();
        // dd($laporan_progja);
            return view('detail', ['progja'=>$progja, 'laporan'=>$laporan_progja ,'anggota'=>$anggota]);

    }
}
