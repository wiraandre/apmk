@extends('main_dashboard')
@section('title','Dashboard')
@section('data_name','Dashboard')
@section('data_menu')
<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#form_pegawai">Tambahkan Data</button>
@endsection
@section('menu_dasbor', 'active')
@section('data_content')
    <div class="col-md-12 border" >
        <br>
        <br>
        <div class="col-md-12">
            <div class="alert alert-primary col-md-12" role="alert">
                div alert
            </div>
            <h4 class="lead">daftar progja</h4>
        </div>
        <div class=" row col-md-12">

            <div class="col-md-6">
                <small class="text-muted" >Contoh tanggal mulai</small> 
            </div>
            <div class="col-md-6 text-right">
                <small class="text-muted">Contoh tanggal selesai</small>
                
            </div>

        </div>
        <div class="col-md-12">
            <label for="customRange2" >Progress</label>
            <input type="range" class="custom-range" disabled value="25" min="0" max="100" id="customRange2">
        </div>
        <div class="col-md-12">
            Tahap laporan
        </div>
    </div>
@endsection
