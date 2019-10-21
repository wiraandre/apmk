<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class user_levelController extends Controller
{
    public function all(){
        $user_level=DB::table('user_level')->get();

        return view('user_level.user_level',['data_user_level'=>$user_level]);
    }

    public function tambah(Request $request){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('user_level')->insert([
            'id_user_level'=>null,
            'nama_user_level'=>$request->nama_user_level,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('user_levelController@all')->with('success','data berhasil diinput');
        }else {
            return redirect()->action('user_levelController@all')->with('danger','gagal');
        }
    }
    public function show($id_user_level){
        $pegawai=DB::table('user_level')->where('id_user_level',$id_user_level)->get();
        return view('user_level.edit_user_level',['data_pegawai'=>$pegawai]);
    }

    public function edit(Request $request, $id_pegawai){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('pegawai')->where('id_pegawai', $id_pegawai)->update([
            'nama_pegawai'=>$request->nama_pegawai,
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
