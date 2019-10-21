<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class anggotaController extends Controller
{
    public function all(){
        
        $anggota=DB::table('anggota')
            ->select('anggota.*', 'progja.nama_progja', 'pegawai.nama_pegawai')
            ->join('progja', 'progja.id_progja', '=', 'anggota.id_progja')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'anggota.id_pegawai')
            ->get();

        $pegawai=DB::table('pegawai')->get();
        $progja=DB::table('progja')->get();

        return view('anggota.anggota',['data_anggota'=>$anggota,'pegawai'=>$pegawai, 'progja'=>$progja]);
    }

    public function tambah(Request $request){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('anggota')->insert([
            'id_anggota'=>null,
            'keterangan_anggota'=>$request->keterangan_anggota,
            'id_pegawai'=>$request->id_pegawai,
            'id_progja'=>$request->id_progja,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('anggotaController@all')->with('success','data berhasil masuk');
        }else {
            return redirect()->action('anggotaController@all')->with('danger','gagal');
        }
    }
    public function show($id_anggota){
        $anggota=DB::table('anggota')->where('id_anggota',$id_anggota)->get();
        $progja=DB::table('progja')->get();
        $pegawai=DB::table('pegawai')->get();
        
        return view('anggota.edit_anggota',['data_anggota'=>$anggota, 'pegawai'=>$pegawai, 'progja'=>$progja]);
    }

    public function edit(Request $request, $id_anggota){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('anggota')->where('id_anggota', $id_anggota)->update([
            'keterangan_anggota'=>$request->keterangan_anggota,
            'id_pegawai'=>$request->id_pegawai,
            'id_progja'=>$request->id_progja,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('anggotaController@all')->with('success','edit berhasil');
        }else {
            return redirect()->action('anggotaController@all')->with('danger','edit gagal');
        }
    }
    public function delete(Request $request){
        // cek nilai variabel
        // dd($request->all());
        $query=DB::table('anggota')->where('id_anggota', $request->id_anggota)->delete();
        if($query){
            return redirect()->action('anggotaController@all')->with('success','hapus berhasil');
        }else {
            return redirect()->action('anggotaController@all')->with('danger','hapus gagal');
        }
    }
}
