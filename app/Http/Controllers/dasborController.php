<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class dasborController extends Controller
{

    public function index()
    {
        $ketua=DB::table('anggota')
            ->where('anggota.keterangan_anggota','=','ketua')
            ->join('progja','progja.id_progja','=','anggota.id_progja')
            ->join('pegawai','pegawai.id_pegawai','=','anggota.id_pegawai')
            ->get();
        $progja=DB::table('progja')
            ->select('progja.*', 'tahun_anggaran.nama_tahun_anggaran', 'pegawai.nama_pegawai', 'anggota.keterangan_anggota')

            ->whereIn('anggota.keterangan_anggota',['ketua','anggota'])

            ->where('pegawai.id_pegawai','=',auth()->user()->id_pegawai)
            ->join('tahun_anggaran', 'progja.id_tahun_anggaran', '=', 'tahun_anggaran.id_tahun_anggaran')
            ->join('anggota', 'progja.id_progja', '=', 'anggota.id_progja')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'anggota.id_pegawai')
            ->get();

        $laporan_progja=DB::table('laporan')
        ->orderBy('id_progja','desc')
        ->orderBy('tanggal_pelaksanaan','desc')
        ->get();
        // dd($laporan_progja);
            return view('dasbor', ['progja'=>$progja, 'laporan'=>$laporan_progja ,'ketua'=>$ketua]);
    }
}
