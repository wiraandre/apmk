@extends('main_dashboard')
@section('title','Users')
@section('data_name','Data Users')
@section('data_menu')
<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#form_users">Tambahkan Data</button>
@endsection
@section('menu_users', 'active')
@section('data_content')
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Nama pegawai</th>
                <th>User level</th>
                <th>Pilihan</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data_users as $data)
                <tr>
                    <td>{{ $data->name }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->nama_pegawai }}</td>
                    <td>{{ $data->nama_user_level }}</td>

                    <td><a href="/users/{{ $data->id }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i>edit</a>
                            <form action="/users" method="post">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <input type="text" value="{{ $data->id }}" name="id" hidden>
                                <button class="btn btn-alert" type="submit" name="hapus">Hapus</button>
                            </form>
                    </td>
                </tr>
            @endforeach    
   
            </tbody>
        </table>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="form_users" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan data users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}

                    <div class="form-group">
                        <label for="users">Nama Pegawai</label>
                        <select name="id_pegawai" required class="form-control" >
                        <option disabled >Pilih pegawai</option>

                            @foreach($pegawai as $data_pegawai)
                                @foreach($data_users as $dataq)
                                    @if($dataq->id_pegawai==$data_pegawai->id_pegawai)
                                    <?php
                                    $lihat_data='No';
                                    break;
                                    ?>
                                    @endif
                                @endforeach
                                @if($lihat_data!='No')
                                    <option value="{{$data_pegawai->id_pegawai}}" >
                                        {{$data_pegawai->nama_pegawai}}
                                    </option>
                                @endif
                                <?php
                                $lihat_data='Yes';
                                ?>
                            @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="users">user name</label>
                        <input type="text" name="name" maxlength="50" required class="form-control" placeholder="masukan nama users">
                    </div>
                    <div class="form-group">
                        <label for="users">email</label>
                        <input type="text" name="email" maxlength="190" required class="form-control" placeholder="masukan email">
                    </div>
                    <div class="form-group">
                        <label for="users">Password</label>
                        <input type="password" name="password" maxlength="50" required class="form-control" placeholder="masukan password">
                    </div>

                    

                    <div class="form-group">
                        <label for="users">User Level</label>
                        <select name="id_user_level" required class="form-control" >
                        <option disabled >Pilih user level</option>
                            @foreach($user_level as $data_user_level)
                                <option value="{{$data_user_level->id_user_level}}" >
                                    {{$data_user_level->nama_user_level}}
                                </option>
                            @endforeach
                            </select>
                    </div>

                    
                    <input type="submit" class="btn btn-primary">

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>
@endsection
