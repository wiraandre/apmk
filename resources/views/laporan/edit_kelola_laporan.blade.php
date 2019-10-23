@extends('main_dashboard')
@section('title','Laporan')
@section('data_name','Laporan')
@section('data_menu')
<a href="/kelola_laporan/{{$id_progja}}/{{$tahap}}" class="btn btn-sm btn-outline-secondary">kembali</a>
@endsection
@section('data_content')
         @foreach($data_laporan as $data)
         <form action="" class="needs-validation" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="laporan">Tahap</label>
                             <select disabled name="tahap" required class="form-control">
                                 <option disabled >Pilih tahapan</option>
                                 <option value="perencanaan" @if($data->tahap == "perencanaan")
                                        selected
                                    @endif
                                    >Tahap perencanaan</option>
                                <option value="pelaksanaan" 
                                @if($data->tahap == "pelaksanaan")
                                        selected
                                    @endif
                                    >Tahap pelaksanaan</option>
                                <option value="evaluasi"
                                @if($data->tahap == "evaluasi")
                                        selected
                                    @endif
                                >Tahap evaluasi</option>
                                <option value="publikasi"
                                @if($data->tahap == "publikasi")
                                        selected
                                    @endif
                                    >Tahap publikasi</option>
                             </select>
                    </div>
                    <div class="form-group">
                        <label for="laporan">Tanggal pelaksanaan</label>
                        <input type="date" name="tanggal_pelaksanaan" value="{{$data->tanggal_pelaksanaan}}" required class="form-control" placeholder="Mohon Masukan Tanggal Laporan yang Valid">
                    </div>
                    <div class="form-group">
                        <label for="laporan">Deskripsi</label>
                        <input type="text" name="deskripsi" value="{{$data->deskripsi}}" required class="form-control" placeholder="Mohon Masukan Deskripsi Laporan">
                    </div>
                    <div class="form-group">
        
                        <label for="laporan">File Laporan  <a href="/file_laporan/{{$data->file_lapor}}">{{ $data->file_lapor }}</a></label>
                        <input type="file" name="file_lapor" class="form-control" placeholder="Mohon Masukan File Laporan">

                    </div>

                    <input type="text" name="file_lapor_lama" value="{{$data->file_lapor}}" hidden="hidden">
                    <div class="form-group">
                        <label for="laporan">Program kerja</label>
                        <select disabled name="id_progja" required class="form-control" >
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
                    <button  type="submit" class="btn btn-primary">Ok</button
                </form>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
                    <input type="submit" class="btn btn-primary">

                </form>
         @endforeach    
   
@endsection
