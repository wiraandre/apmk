@extends('main_dashboard')
@section('title','Program Kerja')
@section('data_name','Program Kerja')
@section('data_menu')
<a href="/progja" class="btn btn-sm btn-outline-secondary">Kembali</a>
@endsection
@section('data_content')
 
         @foreach($data_progja as $data)
         <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                     <div class="form-group">
                        <label for="progja">Nama Program Kerja</label>
                        <input type="text" name="nama_progja" maxlength="100" value="{{$data->nama_progja}}" required class="form-control" placeholder="Masukan nama program kerja">
                    </div>
                    <div class="form-group">
                        <label for="progja">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" value="{{$data->tanggal_mulai}}" required class="form-control" placeholder="Mohon Masukan Tanggal Mulai Progja">
                    </div>
                    <div class="form-group">
                        <label for="progja">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" value="{{$data->tanggal_selesai}}" required class="form-control" placeholder="Mohon Masukan Tanggal Selesai Progja">
                    </div>
                    <div class="form-group">
                        <label for="progja">Tahun Anggaran</label>
                             <select name="id_tahun_anggaran" required class="form-control">
                                 <option disabled >Pilih tahun anggaran</option>
                                 @foreach($tahun_anggaran as $datat)
                                 <option value="{{$datat->id_tahun_anggaran}}"
                                    @if($data->id_tahun_anggaran == $datat->id_tahun_anggaran)
                                        selected
                                    @endif
                                    >
                                     {{$datat->nama_tahun_anggaran}}
                                 </option>
                                 @endforeach
                             </select>
                       <!--  <input type="text" name="id_tahun_anggaran" required class="form-control" placeholder="Mohon Masukan ID Tahun Anggaran yang Valid"> -->
                    </div>
                    <input type="submit" class="btn btn-primary">

                </form>
         @endforeach    
   
@endsection
