@extends('main_dashboard')
@section('title','Data Pegawai')
@section('data_name','Data Pegawai')
@section('data_menu')
<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#form_pegawai">Tambahkan Data</button>
@endsection
@section('menu_pegawai', 'active')
@section('data_content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Nama pegawai</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Agama</th>
                <th>Jabatan</th>
                <th>Pilihan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_pegawai as $data)
                <tr>
                    <td>{{ $data->nama_pegawai }}</td>
                    <td>{{ $data->jenis_kelamin }}</td>
                    <td>{{ $data->tanggal_lahir }}</td>
                    <td>{{ $data->alamat }}</td>
                    <td>{{ $data->agama }}</td>
                    <td>{{ $data->jabatan }}</td>
                    <td><a href="/pegawai/{{ $data->id_pegawai }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>edit</a>
                            <form action="/pegawai" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="text" value="{{ $data->id_pegawai }}" name="id_pegawai" hidden>
                                <button class="btn btn-alert" type="submit" name="hapus">Hapus</button>
                            </form>
                    </td>
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="form_pegawai" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan data pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="pegawai">Nama pegawai</label>
                        <input type="text" name="nama_pegawai" maxlength="50" required class="form-control" placeholder="masukan nama pegawai">
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Jenis Kelamin</label>
                            <select name="jenis_kelamin" required class="form-control">
                                <option disabled >Pilih jenis kelamin</option>
                                <option value="P">Perempuan (P)</option>
                                <option value="L">Laki-laki (L)</option>
                             </select>
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Tanggal lahir</label>
                        <input type="date" name="tanggal_lahir" required class="form-control" placeholder="masukan tanggal lahir pegawai">
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Alamat</label>
                        <input type="text" name="alamat" maxlength="150" required class="form-control" placeholder="masukan alamat pegawai">
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Agama</label>
                            <select name="agama" required class="form-control">
                                <option disabled >Pilih Agama</option>
                                <option value="islam">Islam</option>
                                <option value="kristen">Kristen</option>
                                <option value="khatolik">Khatolik</option>
                                <option value="hindu">hindu</option>
                                <option value="buddha">buddha</option>
                                <option value="kong hucu">kong hucu</option>
                             </select>
                    </div>
                    <div class="form-group">
                        <label for="pegawai">Jabatan</label>
                        <input type="text" name="jabatan" maxlength="50" required class="form-control" placeholder="masukan jabatan pegawai">
                    </div>
                    <input type="submit" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
@endsection
