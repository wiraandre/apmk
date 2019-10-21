<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use dateTime;

class tahun_anggaranController extends Controller
{
    public function all(){
        $tahun=DB::table('tahun_anggaran')->get();

        return view('tahun_anggaran.tahun_anggaran',['data_tahun'=>$tahun]);
    }

    public function tambah(Request $request){
        $date_mulai= dateTime::createFromformat('Y-m-d', $request->tanggal_mulai);
        $date_selesai= dateTime::createFromformat('Y-m-d', $request->tanggal_selesai);
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('tahun_anggaran')->insert([
            'id_tahun_anggaran'=>null,
            'nama_tahun_anggaran'=>$date_mulai->format('Y').'-'.$date_selesai->format('Y'),
            'tanggal_mulai'=>$request->tanggal_mulai,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('tahun_anggaranController@all')->with('success','udah masok');
        }else {
            return redirect()->action('tahun_anggaranController@all')->with('danger','belom masok');
        }
    }
    public function show($id_tahun_anggaran){
        $tahun=DB::table('tahun_anggaran')->where('id_tahun_anggaran',$id_tahun_anggaran)->get();
        return view('tahun_anggaran.edit_tahun_anggaran',['data_tahun'=>$tahun]);
    }

    public function edit(Request $request, $id_tahun_anggaran){
        $date_mulai= dateTime::createFromformat('Y-m-d', $request->tanggal_mulai)->format('Y');
        $date_selesai= dateTime::createFromformat('Y-m-d', $request->tanggal_selesai)->format('Y');
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('tahun_anggaran')->where('id_tahun_anggaran', $id_tahun_anggaran)->update([
            'nama_tahun_anggaran'=>$date_mulai.'-'.$date_selesai,
            'tanggal_mulai'=>$request->tanggal_mulai,
            'tanggal_selesai'=>$request->tanggal_selesai,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('tahun_anggaranController@all')->with('success','edit berhasil');
        }else {
            return redirect()->action('tahun_anggaranController@all')->with('danger','edit gagal');
        }
    }
    public function delete(Request $request){
        // cek nilai variabel
        // dd($request->all());
        $query=DB::table('tahun_anggaran')->where('id_tahun_anggaran', $request->id_tahun_anggaran)->delete();
        if($query){
            return redirect()->action('tahun_anggaranController@all')->with('success','hapus berhasil');
        }else {
            return redirect()->action('tahun_anggaranController@all')->with('danger','hapus gagal');
        }
    }
}
