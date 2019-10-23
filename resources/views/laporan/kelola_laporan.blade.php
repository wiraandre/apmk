@extends('main_dashboard')
@section('title','Kelola Laporan')
@section('data_name','Kelola Laporan')
@section('data_menu')
<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#form_kelola_laporan">Tambahkan Data</button>
@endsection
@section('menu_laporan', 'active')
@section('data_content')

@foreach($progja as $data)
    <h3 class="lead">{{$data->nama_progja}}</h3>
    <hr>
    <ul class="nav nav-tabs">
      <li class="nav-item">
        <a class="nav-link @if($menu_tahap=='perencanaan') active @endif" href="/kelola_laporan/{{$data->id_progja}}/perencanaan">Perencanaan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($menu_tahap=='pelaksanaan') active @elseif($data_perencanaan==0) disabled @endif" href="@if($data_perencanaan==0)# @else /kelola_laporan/{{$data->id_progja}}/pelaksanaan @endif">Pelaksanaan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link @if($menu_tahap=='evaluasi') active @elseif($data_pelaksanaan==0) disabled @endif "  href="@if($data_pelaksanaan==0)# @else /kelola_laporan/{{$data->id_progja}}/evaluasi @endif">Evaluasi</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link @if($data_evaluasi==0) disabled @elseif($menu_tahap=='publikasi') active   @endif "  href="@if($data_evaluasi==0)# @else /kelola_laporan/{{$data->id_progja}}/publikasi @endif">Publikasi</a>
      </li>
    </ul>

 @endforeach
 <br>
 <div class="table-responsive">
        <table class="table table-hover table-sm">
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

                    <td><a href="/kelola_laporan/{{$id_progja}}/{{$tahap}}/{{ $data->id_laporan }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>Ubah</a>
                            <form action="" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="text" value="{{ $data->id_laporan }}" name="id_laporan" hidden>
                                <input type="text" name="file_lapor_lama" value="{{$data->file_lapor}}" hidden="hidden">
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-alert" type="submit" name="hapus">Hapus</button>
                            </form>
                    </td>
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div>   

@endsection


<!-- Modal -->
        <div class="modal fade" id="form_kelola_laporan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Laporan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    
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
                    
                    <button  type="submit" class="btn btn-primary">Ok</button>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>