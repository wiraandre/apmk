<!-- <marquee behavior=scroll direction="right" scrollamount="7000"> -->
@extends('main_dashboard')
@section('title','Detail Progja')
@section('data_name','Detail Progja')
@section('data_menu')

@endsection
@section('menu_dasbor', 'active')
@section('data_content')

<div class="row">
    <div class="table-responsive col-md-6" >    
        <table class="table table-borderless">
            @foreach($progja as $detail_progja)
                <tr>
                    <th width="30%">Program Kerja</th>
                    <td width="5%">:</td>
                    <td>{{$detail_progja->nama_progja}}</td>    
                </tr>
                <tr>
                    <th>Tanggal Mulai</th>
                    <td>:</td>
                    <td>{{$detail_progja->tanggal_mulai}}</td>    
                </tr>
           
                <tr>
                    <th>Tanggal Selesai</th>                
                    <td>:</td>
                    <td>{{$detail_progja->tanggal_selesai}}</td> 
                </tr>
                <tr>
                    <th>Sisa Waktu</th>
                    <td>:</td>
                    <td>{{ Carbon\Carbon::parse(strtotime($detail_progja->tanggal_selesai.' 00:00:00'))->diffForHumans() }}</td> 
                </tr>
                <tr>
                    <th>Tahun Anggaran</th>
                    <td>:</td>
                    <td>{{$detail_progja->nama_tahun_anggaran}}</td> 
                </tr>
                @endforeach
        </table>
      
    </div>

    @foreach($dokumentasi as $detail_dokumentasi)
    

        <div class="col-md-6">
            <div class=" text-center card" style="width: 350px; height:300px ; " >
                <center>
                <img width="200px" height="200px" src="/folderFotoDokumentasi/{{$detail_dokumentasi->foto_dokumentasi}}" " alt="...">
                </center>
            <div class="card-body">
                <p class="card-text">{{$detail_dokumentasi->foto_dokumentasi}}</p>
        </div>
            </div>
            </div>
    @endforeach
</div>


    <hr>
    <h4 class="lead"> Data Anggota Progja </h4>

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Nama Pegawai</th>
                <th>Status Keanggotaan</th>

            </tr>
            </thead>
            <tbody>
            @foreach($anggota as $data_anggota)
                <tr>
                    <td>{{ $data_anggota->nama_pegawai }}</td>
                    <td>{{ $data_anggota->keterangan_anggota }}</td>
                    
                </tr>
            @endforeach    
   
            </tbody>
        </table>

        <hr>
        <br>
            <div class="row col-md-12">
                <h4 class="lead" style="padding-right: 20px" > Data Laporan </h4>
                <a href="/kelola_laporan/{{$detail_progja->id_progja}}/perencanaan">
                    <button  class="btn btn-sm btn-success " >Kelola Laporan</button>
                </a>

            </div>
            <br>

            <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Tanggal Lapor</th>

                <th>Tahap</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Deskripsi</th>
                <th>File Laporan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($laporan as $data)
                <tr>
                    <td>{{ $data->created_at }}</td>

                    <td>{{ $data->tahap }}</td>
                    <td>{{ $data->tanggal_pelaksanaan }}</td>
                    <td>{{ $data->deskripsi }}</td>
                    <td ><a href="/file_laporan/{{$data->file_lapor}}">{{ $data->file_lapor }}</a></td>
    
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div>

   
@endsection
