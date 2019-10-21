@extends('main_dashboard')
@section('title','Tahun Anggaran')
@section('data_name','Tahun Anggaran')
@section('data_menu')
<a href="/tahun_anggaran" class="btn btn-sm btn-outline-secondary">Kembali</a>
@endsection
@section('data_content')
 
         @foreach($data_tahun as $data)
         <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="tahun_anggaran">Tanggal mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{ $data->tanggal_mulai }}" required class="form-control" placeholder="masukan tahun yang bener anjeng">
                    </div>
                     <div class="form-group">
                        <label for="tahun_anggaran">Tanggal selesai</label>
                        <input type="date" name="tanggal_selesai" value="{{ $data->tanggal_selesai }}" required class="form-control" placeholder="masukan tahun yang bener anjeng">
                    </div>
                    <input type="submit" class="btn btn-primary">

                </form>
         @endforeach    
   
@endsection
