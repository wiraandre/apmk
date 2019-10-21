@extends('main_dashboard')
@section('title','User Level')
@section('data_name','User Level')
@section('data_menu')
<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#form_anggota">Tambahkan Data</button>
@endsection
@section('data_content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>User Level</th>
                <th>Pilihan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_user_level as $data)
                <tr>
                    <td>{{ $data->nama_user_level }}</td>
                    <td><a href="/user_level/{{ $data->id_user_level }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>Ubah</a>
                            <form action="/user_level" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="text" value="{{ $data->id_user_level }}" name="id_user_level" hidden>
                                <button onclick="return confirm('Yakin ingin menghapus data?')" class="btn btn-alert" type="submit" name="hapus">Hapus</button>
                            </form>
                    </td>
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="form_user_level" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Data User Level</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                    <div class="form-group">
                        <label for="user_level">User Level</label>
                        <input type="text" name="nama_user_level" required class="form-control" placeholder="Masukan user level">
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
