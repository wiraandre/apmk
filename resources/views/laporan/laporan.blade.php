@extends('main_dashboard')
@section('title','Laporan')
@section('data_name','Laporan')
@section('data_menu')
<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#form_laporan">Tambahkan Data</button>
@endsection
@section('menu_laporan', 'active')
@section('data_content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Tanggal Lapor</th>
                <th>Pogram Kerja</th>
                <th>Tahap</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Deskripsi</th>
                <th>File Laporan</th>
                <th>Pilihan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_laporan as $data)
                <tr>
                    <td>{{ $data->created_at }}</td>
                    <td>{{ $data->nama_progja }}</td>
                    <td>{{ $data->tahap }}</td>
                    <td>{{ $data->tanggal_pelaksanaan }}</td>
                    <td>{{ $data->deskripsi }}</td>
                    <td>{{ $data->file_lapor }}</td>

                    <td><a href="/laporan/{{ $data->id_laporan }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>Ubah</a>
                            <form action="/laporan" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="text" value="{{ $data->id_laporan }}" name="id_laporan" hidden>
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-alert" type="submit" name="hapus">Hapus</button>
                            </form>
                    </td>
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="form_laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="laporan">Tahap</label>
                             <select name="tahap" required class="form-control">
                                 <option disabled >Pilih tahapan</option>
                                 <option value="perencanaan">Tahap perencanaan</option>
                                <option value="pelaksanaan">Tahap pelaksanaan</option>
                                <option value="evaluasi">Tahap evaluasi</option>
                                <option value="publikasi">Tahap publikasi</option>
                             </select>
                    </div>
                    <div class="form-group">
                        <label for="laporan">Tanggal pelaksanaan</label>
                        <input type="date" name="tanggal_pelaksanaan" required class="form-control" placeholder="Mohon Masukan Tanggal Laporan yang Valid">
                    </div>
                    <div class="form-group">
                        <label for="laporan">Deskripsi</label>
                        <input type="text" name="deskripsi" required class="form-control" placeholder="Mohon Masukan Deskripsi Laporan">
                    </div>
                    <div class="form-group">
                        <label for="laporan">File Laporan</label>
                        <input type="file" name="file_lapor" class="form-control" placeholder="Mohon Masukan File Laporan">
                    </div>
                    <div class="form-group">
                        <label for="laporan">Program kerja</label>
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
