@extends('main_dashboard')
@section('title','Kelola dokumentasi')
@section('data_name','Kelola dokumentasi')
@section('data_menu')
<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#form_kelola_laporan">Kembali</button>
@endsection
@section('data_content')

<form action="" class="needs-validation" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="laporan">File Laporan</label>
                        <input type="file" name="foto_dokumentasi" class="form-control" placeholder="Mohon Masukan Dokumentasi">
                    </div>
                    
                    <button  type="submit" class="btn btn-primary">Simpan</button>

                </form>

@endsection
        