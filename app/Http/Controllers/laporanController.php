<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class laporanController extends Controller
{
    public function all(){
        $laporan=DB::table('laporan')
            ->select('laporan.*', 'progja.nama_progja')
            ->join('progja', 'progja.id_progja', '=', 'laporan.id_progja')
            ->get();
        $progja=DB::table('progja')->get();

        return view('laporan.laporan',['data_laporan'=>$laporan, 'progja'=>$progja]);
    }

    public function tambah(Request $request){
        $this->validate($request,['file_lapor'=>'required|file|mimes:pdf|max:2048',]);
        
        $nama_waktu=date('Y_m_d H_i_s');
        $nama_file_lapor=$nama_waktu.' '.$request->file('file_lapor')->getClientOriginalName();
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('laporan')->insert([
            'id_laporan'=>null,
            'tahap'=>$request->tahap,
            'deskripsi'=>$request->deskripsi,
            'id_progja'=>$request->id_progja,
            'tanggal_pelaksanaan'=>$request->tanggal_pelaksanaan,
            'file_lapor'=>$nama_file_lapor,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            $upload_file_lapor=$request->file('file_lapor')
            ->move('file_laporan/',$nama_waktu.' '.$request
            ->file('file_lapor')->getClientOriginalName());
            if ($upload_file_lapor) {
                return redirect()->action('laporanController@all')->with('success','laporan berhasil diinputkan. ');
            }else{ 
                return redirect()->action('laporanController@all')->with('danger','data berhasil masuk, data file gagal upload');

            }
            
        }else {
            return redirect()->action('laporanController@all')->with('danger','gagal');
        }
    }
    public function show($id_laporan){
        $laporan=DB::table('laporan')->where('id_laporan',$id_laporan)->get();
        $progja=DB::table('progja')->get();
        return view('laporan.edit_laporan',['data_laporan'=>$laporan, 'progja'=>$progja]);
    }

    public function edit(Request $request, $id_laporan){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('laporan')->where('id_laporan', $id_laporan)->update([
             'tahap'=>$request->tahap,
            'deskripsi'=>$request->deskripsi,
            'id_progja'=>$request->id_progja,
            'tanggal_pelaksanaan'=>$request->tanggal_pelaksanaan,
            'file_lapor'=>$request->file_lapor,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('laporanController@all')->with('success','edit berhasil');
        }else {
            return redirect()->action('laporanController@all')->with('danger','edit gagal');
        }
    }
    public function delete(Request $request){
        // cek nilai variabel
        // dd($request->all());
        $query=DB::table('laporan')->where('id_laporan', $request->id_laporan)->delete();
        if($query){
            return redirect()->action('laporanController@all')->with('success','hapus berhasil');
        }else {
            return redirect()->action('laporanController@all')->with('danger','hapus gagal');
        }
    }
}
