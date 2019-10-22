<!-- <marquee behavior=scroll direction="right" scrollamount="7000"> -->
@extends('main_dashboard')
@section('title','Dashboard')
@section('data_name','Dashboard')
@section('data_menu')

@endsection
@section('menu_dasbor', 'active')
@section('data_content')

    @foreach($progja as $data_dasbor)
              


    <div class="col-md-12 border" >
        <br>
        <br>

        <div class="col-md-12">
            <div class="alert alert-primary col-md-12" role="alert">
                {{ Carbon\Carbon::parse(strtotime($data_dasbor->tanggal_selesai.' 00:00:00'))->diffForHumans() }}
            </div>
            <small class="text-muted">Tahun Anggaran: {{$data_dasbor->nama_tahun_anggaran}}
            </small>
            <h4 class="lead">Program Kerja: {{$data_dasbor->nama_progja}}</h4>
        </div>
        <hr>
        <div class=" row col-md-12">

            <div class="col-md-6">
                <small class="text-muted" >Tanggal mulai : {{$data_dasbor->tanggal_mulai}}</small> 
            </div>
            <div class="col-md-6 text-right">
                <small class="text-muted">Tanggal selesai : {{$data_dasbor->tanggal_selesai}}</small>
                
            </div>

        </div>
        <br>
        <div class="col-md-12">
            @php
                $status_laporan=0;
                $data_laporan='Tidak ada laporan'
            @endphp
            @foreach($laporan as $laporan1)
            @if($laporan1->id_progja==$data_dasbor->id_progja)
                @php
                    $data_laporan=$laporan1->tahap;
                    $status_laporan=1;
                    break;


                @endphp
            @endif
            @endforeach
            @php
                if($data_laporan=='publikasi')
                $value="100";
                elseif($data_laporan=='evaluasi')
                $value="75";
                elseif($data_laporan=='pelaksanaan')
                $value="50";
                elseif($data_laporan=='perencanaan')
                $value="25";
                else{
                    $value="0";            
                }
                
            @endphp

            <label for="customRange2" >Progress Laporan : {{$data_laporan.' ('.$value.'%)'}} </label>
            <input type="range" class="custom-range" disabled value="{{$value}}"  min="0" max="100"
            
             id="customRange2">
        </div>
        <div class="col-md-12">
            Ketua: {{$data_dasbor->nama_pegawai}}
            <br>
                <!-- <marquee> --><a href="/detail/{{$data_dasbor->id_progja}}" class="btn btn-sm btn-outline-secondary" >Lihat Detail</a></marquee>
            <br>
            <br>
        </div>
    </div>
    <br>
    <br>

    @endforeach
@endsection
