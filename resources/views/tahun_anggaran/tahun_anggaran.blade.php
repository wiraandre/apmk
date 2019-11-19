@extends('main_dashboard')
@section('title','Tahun Anggaran')
@section('data_name','Tahun Anggaran')
@section('data_menu')
<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#form_tahun_anggaran">Tambahkan Data</button>
@endsection
@section('menu_tahun_anggaran', 'active')
@section('data_content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Tahun Anggaran</th>
                <th>Tanggal Mulai</th>
                <th>Tanggal Selesai</th>
                <th>Pilihan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_tahun as $data)
                <tr>
                    <td>{{ $data->nama_tahun_anggaran }}</td>
                    <td>{{ $data->tanggal_mulai }}</td>
                    <td>{{ $data->tanggal_selesai }}</td>
                    <td><a href="/tahun_anggaran/{{ $data->id_tahun_anggaran }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>Ubah</a>
                            <form action="/tahun_anggaran" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="text" value="{{ $data->id_tahun_anggaran }}" name="id_tahun_anggaran" hidden>
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-alert" type="submit" name="hapus">Hapus</button>
                            </form>
                    </td>
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="form_tahun_anggaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Tahun Anggaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="tahun_anggaran">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" required class="form-control" placeholder="Masukan Tanggal mulai tahun anggaran">
                    </div>
                     <div class="form-group">
                        <label for="tahun_anggaran">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" required class="form-control" placeholder="Masukan Tanggal selesai tahun anggaran">
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
