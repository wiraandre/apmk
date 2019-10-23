<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

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
        $dokumentasi=DB::table('progja')
        ->where('laporan.id_progja','=',$id_progja)
        ->join('laporan','progja.id_progja', '=', 'laporan.id_progja')
        ->join('dokumentasi', 'dokumentasi.id_laporan', '=', 'laporan.id_laporan')
        
        ->latest('laporan.created_at')
        ->get();
            
        $laporan_progja=DB::table('laporan')
        ->where('laporan.id_progja','=',$id_progja)
        ->orderBy('tanggal_pelaksanaan','desc')
        ->get();
        // dd($laporan_progja);
            return view('detail', ['progja'=>$progja, 'laporan'=>$laporan_progja ,'anggota'=>$anggota, 'dokumentasi'=>$dokumentasi]);

    }

    public function showpdf($nama_file_laporan)
    {
        $nama_file='file_laporan/'.$nama_file_laporan;
        return Response::make(file_get_contents($nama_file),200,[
            'Content-Type'=>'aplication/pdf',
            'Content-Dispotition'=>'inline,filename="'.$nama_file.'"'
    ]);
    }
}
