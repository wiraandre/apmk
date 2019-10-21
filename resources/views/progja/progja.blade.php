@extends('main_dashboard')
@section('title','Program Kerja')
@section('data_name','Program Kerja')
@section('data_menu')
<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#form_progja">Tambahkan Data</button>
@endsection
@section('menu_progja', 'active')
@section('data_content')

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Program Kerja</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Sisa Waktu</th>
                <th>Tahun Anggaran</th>
                <th>Pilihan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_progja as $data)
                <tr>
                    <td>{{ $data->nama_progja }}</td>
                    <td>{{ $data->tanggal_mulai }}</td>
                    <td>{{ $data->tanggal_selesai }}</td>
                    <td>{{ Carbon\Carbon::parse(strtotime($data->tanggal_selesai.' 00:00:00'))->diffForHumans() }}</td>
                    <td>{{ $data->nama_tahun_anggaran }}</td>
                    <td><a href="/progja/{{ $data->id_progja }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>Ubah</a>
                            <form action="/progja" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="text" value="{{ $data->id_progja }}" name="id_progja" hidden>
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-alert" type="submit" name="hapus">Hapus</button>
                            </form>
                    </td>
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="form_progja" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Program Kerja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="progja">Nama Program Kerja</label>
                        <input type="text" name="nama_progja" maxlength="100" required class="form-control" placeholder="Masukan nama program kerja">
                    </div>
                    <div class="form-group">
                        <label for="progja">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" required class="form-control" placeholder="Mohon Masukan Tanggal Mulai Progja">
                    </div>
                    <div class="form-group">
                        <label for="progja">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" required class="form-control" placeholder="Mohon Masukan Tanggal Selesai Progja">
                    </div>
                    <div class="form-group">
                        <label for="progja">Tahun Anggaran</label>
                             <select name="id_tahun_anggaran" required class="form-control">
                                 <option disabled >Pilih tahun anggaran</option>
                                 @foreach($tahun_anggaran as $datat)
                                 <option value="{{$datat->id_tahun_anggaran}}">
                                     {{$datat->nama_tahun_anggaran}}
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
