@extends('main_dashboard')
@section('title','Anggota')
@section('data_name','Anggota')
@section('data_menu')
<a href="/anggota" class="btn btn-sm btn-outline-secondary">kembali</a>
@endsection
@section('data_content')
 
         @foreach($data_anggota as $data)
         <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="anggota">Nama Pegawai</label>
                        <select name="id_pegawai" required class="form-control" >
                        <option disabled >Pilih pegawai</option>
                            @foreach($pegawai as $data_pegawai)
                                <option value="{{$data_pegawai->id_pegawai}}" 
                                    @if($data->id_pegawai == $data_pegawai->id_pegawai)
                                        selected
                                    @endif
                                    >
                                    {{$data_pegawai->nama_pegawai}}
                                </option>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="anggota">Status Keanggotaan</label>
                        <input type="text" name="keterangan_anggota" maxlength="100" value="{{$data->keterangan_anggota}}" required class="form-control" placeholder="Mohon Status Keanggotaan">
                    </div>
                    <div class="form-group">
                        <label for="anggota">Program Kerja yang dilaksanakan</label>
                            <select name="id_progja" required class="form-control" >
                                <option disabled >Pilih Program kerja</option>
                                    @foreach($progja as $data_progja)
                                    <option value="{{$data_progja->id_progja}}" 
                                        @if($data->id_progja == $data_progja->id_progja)
                                        selected
                                    @endif
                                    >
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
                    <input type="submit" class="btn btn-primary">

                </form>
         @endforeach    
   
@endsection
