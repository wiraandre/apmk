<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware'=>['auth','cekuserlevel:1']],function(){

	Route::get('/' ,'dasborController@index');
	Route::get('/detail/{id_progja}', 'detailController@index');


	//tahun anggaran
	Route::get('/tahun_anggaran', 'tahun_anggaranController@all');
	Route::delete('/tahun_anggaran', 'tahun_anggaranController@delete');
	Route::get('/tahun_anggaran/{id_tahun_anggaran}', 'tahun_anggaranController@show');
	Route::post('/tahun_anggaran', 'tahun_anggaranController@tambah');
	Route::put('/tahun_anggaran/{id_tahun_anggaran}', 'tahun_anggaranController@edit');

	//pegawai
	Route::get('/pegawai', 'pegawaiController@all');
	Route::delete('/pegawai', 'pegawaiController@delete');
	Route::get('/pegawai/{id_pegawai}', 'pegawaiController@show');
	Route::post('/pegawai', 'pegawaiController@tambah');
	Route::put('/pegawai/{id_pegawai}', 'pegawaiController@edit');

	//anggota
	Route::get('/anggota', 'anggotaController@all');
	Route::delete('/anggota', 'anggotaController@delete');
	Route::get('/anggota/{id_anggota}', 'anggotaController@show');
	Route::post('/anggota', 'anggotaController@tambah');
	Route::put('/anggota/{id_anggota}', 'anggotaController@edit');

	//dokumentasi
	Route::get('/dokumentasi', 'dokumentasiController@all');
	Route::delete('/dokumentasi', 'dokumentasiController@delete');
	Route::get('/dokumentasi/{id_dokumentasi}', 'dokumentasiController@show');
	Route::post('dokumentasi', 'dokumentasiController@tambah');
	Route::put('/dokumentasi/{id_dokumentasi}', 'dokumentasiController@edit');

	//progja
	Route::get('/progja', 'progjaController@all');
	Route::delete('/progja', 'progjaController@delete');
	Route::get('/progja/{id_progja}', 'progjaController@show');
	Route::post('/progja', 'progjaController@tambah');
	Route::put('/progja/{id_progja}', 'progjaController@edit');

	//users
	Route::get('/users', 'usersController@all');
	Route::delete('/users', 'usersController@delete');
	Route::get('/users/{id_users}', 'usersController@show');
	Route::post('/users', 'usersController@tambah');
	Route::put('/users/{id_users}', 'usersController@edit');

	//ubah password
	Route::put('/users/{id}/ubahpassword', 'usersController@ubahpassword');

	//user_level
	Route::get('/user_level', 'user_levelController@all');
	Route::delete('/user_level', 'user_levelController@delete');
	Route::get('/user_level/{id_user_level}', 'user_levelController@show');
	Route::post('/user_level', 'user_levelController@tambah');
	Route::put('/user_level/{id_user_level}', 'user_levelController@edit');

	//laporan
	Route::get('/laporan', 'laporanController@all');
	Route::delete('/laporan', 'laporanController@delete');
	Route::get('/laporan/{id_laporan}', 'laporanController@show');
	Route::post('/laporan', 'laporanController@tambah');
	Route::put('/laporan/{id_laporan}', 'laporanController@edit');
	Route::get('/logout', 'loginController@logout');
});
	//login
	Route::get('/login', 'loginController@index')->name('login');
	Route::post('/login', 'loginController@login');

