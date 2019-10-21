<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class pegawaiController extends Controller
{
    public function all(){
        $pegawai=DB::table('pegawai')->get();

        return view('pegawai.pegawai',['data_pegawai'=>$pegawai]);
    }

    public function tambah(Request $request){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('pegawai')->insert([
            'id_pegawai'=>null,
            'nama_pegawai'=>$request->nama_pegawai,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'alamat'=>$request->alamat,
            'agama'=>$request->agama,
            'jabatan'=>$request->jabatan,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('pegawaiController@all')->with('success','Data berhasil masuk');
        }else {
            return redirect()->action('pegawaiController@all')->with('danger','Gagal');
        }
    }
    public function show($id_pegawai){
        $pegawai=DB::table('pegawai')->where('id_pegawai',$id_pegawai)->get();
        return view('pegawai.edit_pegawai',['data_pegawai'=>$pegawai]);
    }

    public function edit(Request $request, $id_pegawai){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('pegawai')->where('id_pegawai', $id_pegawai)->update([
            'nama_pegawai'=>$request->nama_pegawai,
            'jenis_kelamin'=>$request->jenis_kelamin,
            'tanggal_lahir'=>$request->tanggal_lahir,
            'alamat'=>$request->alamat,
            'agama'=>$request->agama,
            'jabatan'=>$request->jabatan,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('pegawaiController@all')->with('success','edit berhasil');
        }else {
            return redirect()->action('pegawaiController@all')->with('danger','edit gagal');
        }
    }
    public function delete(Request $request){
        // cek nilai variabel
        // dd($request->all());
        $query=DB::table('pegawai')->where('id_pegawai', $request->id_pegawai)->delete();
        if($query){
            return redirect()->action('pegawaiController@all')->with('success','hapus berhasil');
        }else {
            return redirect()->action('pegawaiController@all')->with('danger','hapus gagal');
        }
    }
}
