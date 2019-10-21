@extends('main_dashboard')
@section('title','Anggota')
@section('data_name','Anggota')
@section('data_menu')
<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#form_anggota">Tambahkan Data</button>
@endsection
@section('menu_anggota', 'active')
@section('data_content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Status Keanggotaan</th>
                <th>Program Kerja Yang Sedang Dilaksanakan</th>
                <th>Pilihan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_anggota as $data)
                <tr>
                    <td>{{ $data->nama_pegawai }}</td>
                    <td>{{ $data->keterangan_anggota }}</td>
                    <td>{{ $data->nama_progja }}</td>
                    <td><a href="/anggota/{{ $data->id_anggota }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>Ubah</a>
                            <form action="/anggota" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="text" value="{{ $data->id_anggota }}" name="id_anggota" hidden>
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-alert" type="submit" name="hapus">Hapus</button>
                            </form>
                    </td>
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="form_anggota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Anggota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="anggota">Nama Pegawai</label>
                        <select name="id_pegawai" required class="form-control" >
                        <option disabled >Pilih pegawai</option>
                            @foreach($pegawai as $data_pegawai)
                                <option value="{{$data_pegawai->id_pegawai}}" >
                                    {{$data_pegawai->nama_pegawai}}
                                </option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="anggota">Status Keanggotaan</label>
                        <input type="text" name="keterangan_anggota" maxlength="100" required class="form-control" placeholder="Mohon Status Keanggotaan">
                    </div>
                    <div class="form-group">
                        <label for="anggota">Program Kerja yang dilaksanakan</label>
                            <select name="id_progja" required class="form-control" >
                                <option disabled >Pilih Program kerja</option>
                                    @foreach($progja as $data_progja)
                                    <option value="{{$data_progja->id_progja}}">
                                        {{$data_progja->nama_progja}}
                                    </option>
                                    @endforeach
                            </select>
                    </div>
                    <button  type="submit" class="btn btn-primary">Ok</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
@endsection
