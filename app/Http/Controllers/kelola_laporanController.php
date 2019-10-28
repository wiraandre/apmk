<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;

class kelola_laporanController extends Controller
{
    public function index($id_progja,$tahap)
    {
        $laporan=DB::table('laporan')
            ->where('laporan.id_progja','=',$id_progja)
            ->select('laporan.*', 'progja.nama_progja')
            ->where('tahap','=',$tahap)
            ->join('progja', 'progja.id_progja', '=', 'laporan.id_progja')
            ->get();
        $progja=DB::table('progja')
        ->where('id_progja','=',$id_progja)
        ->get();

        $perencanaan=DB::table('laporan')
        ->where('laporan.id_progja','=',$id_progja)
        ->where('tahap','=','perencanaan')
        ->join('progja','laporan.id_progja','=','progja.id_progja')
        ->count();

        $pelaksanaan=DB::table('laporan')
        ->where('laporan.id_progja','=',$id_progja)
        ->where('tahap','=','pelaksanaan')
        ->join('progja','laporan.id_progja','=','progja.id_progja')
        ->count();

        $evaluasi=DB::table('laporan')
        ->where('laporan.id_progja','=',$id_progja)
        ->where('tahap','=','evaluasi')
        ->join('progja','laporan.id_progja','=','progja.id_progja')
        ->count();

        $dokumentasi=DB::table('dokumentasi')
        ->where('laporan.id_progja','=',$id_progja)
        ->where('laporan.tahap', '=',$tahap )
        ->join('laporan','laporan.id_laporan', '=', 'dokumentasi.id_laporan')
        ->join('progja', 'progja.id_progja', '=', 'laporan.id_progja')
        ->get();

        $menu_tahap=$tahap;

        return view('laporan.kelola_laporan',['data_laporan'=>$laporan, 'progja'=>$progja, 'data_perencanaan'=>$perencanaan, 'data_pelaksanaan'=>$pelaksanaan, 'data_evaluasi'=>$evaluasi, 'menu_tahap'=>$menu_tahap, 'tahap'=>$tahap, 'id_progja'=>$id_progja, 'dokumentasi'=>$dokumentasi]);
    }


        public function tambah(Request $request, $id_progja, $tahap){
        $this->validate($request,['file_lapor'=>'required|file|mimes:pdf|max:2048',]);
        
        $nama_waktu=date('Y_m_d H_i_s');
        $nama_file_lapor=$nama_waktu.' '.$request->file('file_lapor')->getClientOriginalName();
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('laporan')->insert([
            'id_laporan'=>null,
            'tahap'=>$tahap,
            'deskripsi'=>$request->deskripsi,
            'id_progja'=>$id_progja,
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
                return redirect('kelola_laporan/'.$id_progja.'/'.$tahap)->with('success','laporan berhasil diinputkan. ');
            }else{ 
                return redirect('kelola_laporan/'.$id_progja.'/'.$tahap)->with('danger','data berhasil masuk, data file gagal upload');

            }
            
        }else {
            return redirect('kelola_laporan/'.$id_progja.'/'.$tahap)->with('danger','gagal');
        }
    }

    public function delete(Request $request,$id_progja,$tahap){
        // cek nilai variabel
        // dd($request->all());
        $query=DB::table('laporan')->where('id_laporan', $request->id_laporan)->delete();
        if($query){
            $hapus=File::delete('file_laporan/'.$request->file_lapor_lama);
            if($hapus){
                return redirect('kelola_laporan/'.$id_progja.'/'.$tahap)->with('success','hapus berhasil');
            }
        }else {
            return redirect('kelola_laporan/'.$id_progja.'/'.$tahap)->with('danger','hapus gagal');
        }
    }



    public function show($id_progja, $tahap, $id_laporan ){
        $laporan=DB::table('laporan')->where('id_laporan',$id_laporan)->get();
        $progja=DB::table('progja')->get();
        return view('laporan.edit_kelola_laporan',['data_laporan'=>$laporan, 'progja'=>$progja, 'id_progja'=>$id_progja, 'tahap'=>$tahap]);
    }
    public function edit(Request $request, $id_progja, $tahap,$id_laporan){
        $this->validate($request,['file_lapor'=>'file|mimes:pdf|max:2048',]);
        $nama_waktu=date('Y_m_d H_i_s');
        if ($request->hasFile('file_lapor')){
            $nama_file_lapor=$nama_waktu.' '.$request->file('file_lapor')->getClientOriginalName();
        }else{
            $nama_file_lapor=$request->file_lapor_lama;
        }
        
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('laporan')->where('id_laporan', $id_laporan)->update([
             'tahap'=>$tahap,
            'deskripsi'=>$request->deskripsi,
            'id_progja'=>$id_progja,
            'tanggal_pelaksanaan'=>$request->tanggal_pelaksanaan,
            'file_lapor'=>$nama_file_lapor,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            if ($request->hasFile('file_lapor')){
                $upload_file_lapor=$request->file('file_lapor')
                ->move('file_laporan/',$nama_waktu.' '.$request
                ->file('file_lapor')->getClientOriginalName());
                File::delete('file_laporan/'.$request->file_lapor_lama);
            }
            return redirect('kelola_laporan/'.$id_progja.'/'.$tahap)->with('success','laporan berhasil diinputkan. ');
        }else {
            return redirect('kelola_laporan/'.$id_progja.'/'.$tahap)->with('danger','gagal');
        }
    }
}
