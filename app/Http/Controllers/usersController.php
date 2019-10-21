<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
class usersController extends Controller
{
        public function all(){
         $users=DB::table('users')
            ->select('users.*', 'user_level.nama_user_level', 'pegawai.nama_pegawai')
            ->join('user_level', 'user_level.id_user_level', '=', 'users.id_user_level')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'users.id_pegawai')
            ->get();

        $pegawai=DB::table('pegawai')->get();
        $user_level=DB::table('user_level')->get();

        return view('users.users',['data_users'=>$users,'pegawai'=>$pegawai, 'user_level'=>$user_level]);
    }

    public function tambah(Request $request){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('users')->insert([
            'id'=>null,
            'name'=>$request->name,
            'email'=>$request->email,
            'email_verified_at'=>null,
            'password'=>bcrypt($request->password),
            'id_pegawai'=>$request->id_pegawai,
            'id_user_level'=>$request->id_user_level,
            'remember_token'=>$request->_token,
            'created_at'=>$waktu_sekarang,
            'updated_at'=>$waktu_sekarang


        ]);
        if($query){
            return redirect()->action('usersController@all')->with('success','Data berhasil masuk');
        }else {
            return redirect()->action('usersController@all')->with('danger','Gagal');
        }
    }
    public function show($id){
			$users=DB::table('users')
            ->select('users.*', 'user_level.nama_user_level', 'pegawai.nama_pegawai')
            ->where('users.id','=',$id)
            ->join('user_level', 'user_level.id_user_level', '=', 'users.id_user_level')
            ->join('pegawai', 'pegawai.id_pegawai', '=', 'users.id_pegawai')
            ->get();

            $user_level=DB::table('user_level')->get();
        return view('users.edit_users',['data_users'=>$users, 'user_level'=>$user_level]);
    }

    public function edit(Request $request, $id){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('users')->where('id', $id)->update([

            'name'=>$request->name,
            'email'=>$request->email,

            'id_user_level'=>$request->id_user_level,
            'remember_token'=>$request->_token,
            'updated_at'=>$waktu_sekarang
        ]);
        if($query){
            return redirect()->action('usersController@all')->with('success','edit berhasil');
        }else {
            return redirect()->action('usersController@all')->with('danger','edit gagal');
        }
    }


    public function ubahpassword(Request $request, $id){
        $waktu_sekarang=date('Y-m-d H:i:s');
        $query=DB::table('users')->where('id', $id)->update([
            'password'=>bcrypt($request->password)  
        ]);
        if($query){
            return redirect()->action('usersController@all')->with('success','edit berhasil');
        }else {
            return redirect()->action('usersController@all')->with('danger','edit gagal');
        }
    }
    public function delete(Request $request){
        // cek nilai variabel
        // dd($request->all());
        $query=DB::table('users')->where('id', $request->id)->delete();
        if($query){
            return redirect()->action('usersController@all')->with('success','hapus berhasil');
        }else {
            return redirect()->action('usersController@all')->with('danger','hapus gagal');
        }
    }

}
