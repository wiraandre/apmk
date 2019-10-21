<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class progjaController extends Controller
{
    public function all(){
        $progja=DB::table('progja')
            ->select('progja.*', 'tahun_anggaran.nama_tahun_anggaran')
            ->join('tahun_anggaran', 'progja.id_tahun_anggaran', '=', 'tahun_anggaran.id_tahun_anggaran')
            ->get();
        $tahun_anggaran=DB::table('tahun_anggaran')->get();

        return view('progja.progja',['data_progja'=>$progja, 'tahun_anggaran'=>$tahun_anggaran]);
    }

    public function tambah(Request $request){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('progja')->insert([
            'id_progja'=>null,
            'nama_progja'=>$request->nama_progja,
            'tanggal_mulai'=>$request->tanggal_mulai,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'id_tahun_anggaran'=>$request->id_tahun_anggaran,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('progjaController@all')->with('success','Data berhasil masuk');
        }else {
            return redirect()->action('progjaController@all')->with('danger','Proses gagal');
        }
    }
    public function show($id_progja){
         $progja=DB::table('progja')
            ->select('progja.*', 'tahun_anggaran.nama_tahun_anggaran')
            ->where('id_progja', $id_progja)
            ->join('tahun_anggaran', 'progja.id_tahun_anggaran', '=', 'tahun_anggaran.id_tahun_anggaran')
            ->get();
        $tahun_anggaran=DB::table('tahun_anggaran')->get();
        return view('progja.edit_progja',['data_progja'=>$progja, 'tahun_anggaran'=>$tahun_anggaran]);
    }

    public function edit(Request $request, $id_progja){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('progja')->where('id_progja', $id_progja)->update([
            'nama_progja'=>$request->nama_progja,
            'tanggal_mulai'=>$request->tanggal_mulai,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'id_tahun_anggaran'=>$request->id_tahun_anggaran,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('progjaController@all')->with('success','edit berhasil');
        }else {
            return redirect()->action('progjaController@all')->with('danger','edit gagal');
        }
    }
    public function delete(Request $request){
        // cek nilai variabel
        // dd($request->all());
        $query=DB::table('progja')->where('id_progja', $request->id_progja)->delete();
        if($query){
            return redirect()->action('progjaController@all')->with('success','hapus berhasil');
        }else {
            return redirect()->action('progjaController@all')->with('danger','hapus gagal');
        }
    }
}
