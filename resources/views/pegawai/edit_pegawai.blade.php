@extends('main_dashboard')
@section('title','Pegawai')
@section('data_name','Pegawai')
@section('data_menu')
<a href="/pegawai" class="btn btn-sm btn-outline-secondary">kembali</a>
@endsection
@section('data_content')
 
         @foreach($data_pegawai as $data)
         <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="pegawai">Data pegawai</label>
                        <input type="year" name="nama_pegawai" maxlength="50" value="{{ $data->nama_pegawai }}" required class="form-control" placeholder="masukan nama pegawai">
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Jenis Kelamin</label>
                            <select name="jenis_kelamin" value="{{ $data->jenis_kelamin }}" required class="form-control">
                                <option disabled >Pilih jenis kelamin</option>
                                <option value="P" @if($data->jenis_kelamin == 'P')
                                    selected
                                    @endif>Perempuan (P)</option>
                                <option value="L" @if($data->jenis_kelamin == 'L')
                                    selected
                                    @endif>Laki-laki (L)</option>
                             </select>
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Tanggal lahir</label>
                        <input type="text" name="tanggal_lahir" value="{{ $data->tanggal_lahir }}" required class="form-control" placeholder="masukan tanggal lahir pegawai">
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Alamat</label>
                        <input type="text" name="alamat" maxlength="150" value="{{ $data->alamat }}" required class="form-control" placeholder="masukan alamat pegawai">
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Agama</label>
                            <select name="agama" value="{{ $data->agama }}" required class="form-control">
                                <option disabled >Pilih Agama</option>
                                <option value="islam" @if($data->agama == 'islam')
                                    selected
                                    @endif>Islam</option>
                                <option value="kristen" @if($data->agama == 'kristen')
                                    selected
                                    @endif>Kristen</option>
                                <option value="khatolik" @if($data->agama == 'khatolik')
                                    selected
                                    @endif>Khatolik</option>
                                <option value="hindu" @if($data->agama == 'hindu')
                                    selected
                                    @endif>hindu</option>
                                <option value="buddha" @if($data->agama == 'buddha')
                                    selected
                                    @endif>buddha</option>
                                <option value="kong hucu" @if($data->agama == 'kong hucu')
                                    selected
                                    @endif>kong hucu</option>
                             </select>
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Jabatan</label>
                        <input type="text" name="jabatan" maxlength="50" value="{{ $data->jabatan }}" required class="form-control" placeholder="masukan jabatan pegawai">
                    </div>
                    <input type="submit" class="btn btn-primary">

                </form>
         @endforeach    
   
@endsection
