@extends('main_dashboard')
@section('title','Kelola Laporan')
@section('data_name','Kelola Laporan')
@section('data_menu')
<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#form_kelola_laporan">Tambahkan Data</button>
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
        <table class="table table-hover table-bordered table-sm">
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

                    <td>
                        <div class="btn-group" role="group">

                        <a href="/kelola_laporan/{{$id_progja}}/{{$tahap}}/{{ $data->id_laporan }}" >
                            <button class="btn btn-warning"> Ubah </button>
                        </a>

                            <form action="" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="text" value="{{ $data->id_laporan }}" name="id_laporan" hidden>
                                <input type="text" name="file_lapor_lama" value="{{$data->file_lapor}}" hidden="hidden">
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-alert" type="submit" name="hapus">Hapus</button>
                            </form>
                        </div>
                        <a href="/kelola_laporan/{{$data->id_progja}}/{{$data->tahap}}/{{$data->id_laporan}}/dokumentasi/tambah">
                        <button class="btn btn-outline-primary btn-sm">Tambahkan Dokumentasi</button>
                        </a>
                    </td>
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div> 
    <hr>
    
    <div>
        <h6>Dokumentasi</h6>
        <hr>
        <div class="card-columns">
        @forelse($dokumentasi as $detail_dokumentasi)
        
        <div class="card" style="width: 200px; ">
          <img  src=" /folderFotoDokumentasi/{{$detail_dokumentasi->foto_dokumentasi}}"  class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text" align="center">{{$detail_dokumentasi->tanggal_pelaksanaan}} <br> Deskripsi laporan: {{$detail_dokumentasi->deskripsi}}</p>

            <form action="/kelola_laporan/{{$detail_dokumentasi->id_progja}}/{{$detail_dokumentasi->tahap}}/{{$detail_dokumentasi->id_laporan}}/dokumentasi/delete" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="text" value="{{ $detail_dokumentasi->id_dokumentasi }}" name="id_dokumentasi" hidden>
                <input type="text" value="{{ $detail_dokumentasi->foto_dokumentasi }}" name="foto_dokumentasi" hidden>
                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-alert" type="submit" name="hapus">Hapus</button>
            </form>
          </div>
        </div>
        
         @empty
         
         <div>
             <p>Dokumentasi kosong</p>
         </div>
         
         @endforelse
         </div>
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