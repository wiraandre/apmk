@extends('main_dashboard')
@section('title','Dokumentasi')
@section('data_name','Dokumentasi')
@section('data_menu')
<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#form_dokumentasi">Tambahkan Data</button>
@endsection
@section('menu_dokumentasi', 'active')
@section('data_content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Dokumentasi</th>
              
                <th>Pilihan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_dokumentasi as $data)
                <tr>
                    <td><img src="{{asset('folderFotoDokumentasi/'.$data->foto_dokumentasi)}}" class="img-circle" alt="foto dokumentasi" width="350px" height="200px"></td>
                    
                    <td><!-- <a href="/dokumentasi/{{ $data->id_dokumentasi }}" class="btn btn-warning"> -->
                            <!-- <i class="fas fa-edit"></i>Ubah</a> -->
                            <form action="/dokumentasi" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="text" value="{{ $data->id_dokumentasi }}" name="id_dokumentasi" hidden>
                                <input type="text" value="{{ $data->foto_dokumentasi }}" name="foto_dokumentasi" hidden>
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-alert" type="submit" name="hapus">Hapus</button>
                            </form>
                    </td>
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="form_dokumentasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Data Dokumentasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="dokumentasi"> Foto Dokumentasi</label>
                        <input type="file" name="foto_dokumentasi" maxlength="100" required class="form-control" placeholder="Masukan dokumentasi">
                    </div>
                    
                    <div class="form-group">
                        <label for="dokumentasi">Laporan</label>
                        <select name="id_laporan" required class="form-control" >
                        <option disabled >Tambahkan dokumentasi untuk laporan</option>
                            @foreach($laporan as $data_laporan)
                                <option value="{{$data_laporan->id_laporan}}" >
                                    ({{$data_laporan->tanggal_pelaksanaan}}) {{$data_laporan->tahap}} | {{$data_laporan->nama_progja}} 
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
