<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;

class kelola_dokumentasiController extends Controller
{
    public function index($id_progja,$tahap,$id_laporan)
    {
        return view('laporan.kelola_dokumentasi');
    }

      public function tambah(Request $request, $id_progja,$tahap,$id_laporan){
        $this->validate($request, [
            'foto_dokumentasi'=>'required|file|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);
        $nama_waktu=date('Y_m_d H_i_s');
        $foto_dokumentasi=$nama_waktu.' '.$request->file('foto_dokumentasi')->getClientOriginalName();
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('dokumentasi')->insert([
            'id_dokumentasi'=>null,
            'foto_dokumentasi'=>$foto_dokumentasi,
            'id_laporan'=>$id_laporan,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            $upload_file_dokumentasi=$request->file('foto_dokumentasi')
            ->move('folderFotoDokumentasi/',$nama_waktu.' '.$request
            ->file('foto_dokumentasi')->getClientOriginalName());
            if ($upload_file_dokumentasi) {
                return redirect('/kelola_laporan/'.$id_progja.'/'.$tahap)->with('success','Dokumentasi berhasil diinputkan. ');
            }else{ 
                return redirect('/kelola_laporan/'.$id_progja.'/'.$tahap)->with('danger','data berhasil masuk, data file gagal upload');
            }
            
        }else {
            return redirect('/kelola_laporan/'.$id_progja.'/'.$tahap)->with('danger','gagal');
        }
    }


     public function delete(Request $request, $id_progja,$tahap,$id_laporan){
        // cek nilai variabel
        // dd($request->all());
        $query=DB::table('dokumentasi')->where('id_dokumentasi', $request->id_dokumentasi)->delete();
        if($query){
            File::delete('folderFotoDokumentasi/'.$request->foto_dokumentasi);
            return redirect('/kelola_laporan/'.$id_progja.'/'.$tahap)->with('success','hapus berhasil');
        }else {
            return redirect('/kelola_laporan/'.$id_progja.'/'.$tahap)->with('danger','hapus gagal');
        }
    }

}
