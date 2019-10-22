<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;
use Response;

class dokumentasiController extends Controller
{
    public function all(){
        $dokumentasi=DB::table('dokumentasi')->get();
      
        $laporan=DB::table('laporan')
            ->select('laporan.*', 'progja.nama_progja')
            ->join('progja', 'progja.id_progja', '=', 'laporan.id_progja')
            ->orderBy('tanggal_pelaksanaan', 'desc')
            ->get();
        return view('dokumentasi.dokumentasi',['data_dokumentasi'=>$dokumentasi, 'laporan'=>$laporan]);
    }

    public function tambah(Request $request){
        $this->validate($request, [
            'foto_dokumentasi'=>'required|file|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);
        $nama_waktu=date('Y_m_d H_i_s');
        $foto_dokumentasi=$nama_waktu.' '.$request->file('foto_dokumentasi')->getClientOriginalName();
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('dokumentasi')->insert([
            'id_dokumentasi'=>null,
            'foto_dokumentasi'=>$foto_dokumentasi,
   
            'id_laporan'=>$request->id_laporan,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            $upload_file_dokumentasi=$request->file('foto_dokumentasi')
            ->move('folderFotoDokumentasi/',$nama_waktu.' '.$request
            ->file('foto_dokumentasi')->getClientOriginalName());
            if ($upload_file_dokumentasi) {
                return redirect()->action('dokumentasiController@all')->with('success','Dokumentasi berhasil diinputkan. ');
            }else{ 
                return redirect()->action('dokumentasiController@all')->with('danger','data berhasil masuk, data file gagal upload');

            }
            
        }else {
            return redirect()->action('dokumentasiController@all')->with('danger','gagal');
        }
    }
    public function show($id_dokumentasi){
        $dokumentasi=DB::table('dokumentasi')->where('id_dokumentasi',$id_dokumentasi)->get();
        return view('dokumentasi.edit_dokumentasi',['data_dokumentasi'=>$dokumentasi, 'laporan'=>$laporan]);
    }

    public function edit(Request $request, $id_dokumentasi){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('dokumentasi')->where('id_dokumentasi', $id_dokumentasi)->update([
            'dokumentasi'=>$request->dokumentasi,

            'id_laporan'=>$request->id_laporan,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('dokumentasiController@all')->with('success','edit berhasil');
        }else {
            return redirect()->action('dokumentasiController@all')->with('danger','edit gagal');
        }
    }
    public function delete(Request $request){
        // cek nilai variabel
        // dd($request->all());
        $query=DB::table('dokumentasi')->where('id_dokumentasi', $request->id_dokumentasi)->delete();
        if($query){
            File::delete('folderFotoDokumentasi/'.$request->foto_dokumentasi);
            return redirect()->action('dokumentasiController@all')->with('success','hapus berhasil');
        }else {
            return redirect()->action('dokumentasiController@all')->with('danger','hapus gagal');
        }
    }
}
