@extends('main_dashboard')
@section('title','Users')
@section('data_name','Data Users')
@section('data_menu')
<a href="/users" class="btn btn-sm btn-outline-secondary">kembali</a>
@endsection
@section('data_content')
 
         @foreach($data_users as $data)
         <form action="" class="needs-validation" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="users">Nama Pegawai</label>
                        <select name="id_pegawai" disabled class="form-control" >
                        <option disabled >Pilih pegawai</option>

                                    <option value="{{$data->id_pegawai}}" >
                                        {{$data->nama_pegawai}}
                                    </option>
                                
                            </select>
                    </div>

                     <div class="form-group">
                        <label for="users">user name</label>
                        <input type="text" name="name" maxlength="50" value="{{$data->name}}" required class="form-control" placeholder="masukan nama users">
                    </div>
                    <div class="form-group">
                        <label for="users">email</label>
                        <input type="text" name="email" maxlength="190" value="{{$data->email}}" required class="form-control" placeholder="masukan email">
                    </div>

                    <div class="form-group">
                        <label for="users">User Level</label>
                        <select name="id_user_level" required class="form-control" >
                        <option disabled >Pilih user level</option>
                            @foreach($user_level as $data_user_level)
                                <option value="{{$data_user_level->id_user_level}}"
                                     @if($data->id_user_level == $data_user_level->id_user_level)
                                        selected
                                    @endif
                                    >

                                    {{$data_user_level->nama_user_level}}
                                </option>
                            @endforeach
                            </select>
                    </div>
                    
                    <input type="submit" class="btn btn-primary" value="simpan perubahan">

                </form>
                <hr>
                <form method="post" action="/users/{{$data->id}}/ubahpassword">
                    {{ csrf_field() }}
                     {{ method_field('PUT') }}
                   <div class="form-group">
                    <h4>
                        <label for="users">Ganti Password</label>
                    </h4>
                        <input type="password" name="password" maxlength="50"  required class="form-control" placeholder="masukan password">

                    </div> 
                    <input type="submit" class="btn btn-warning" value="ubah password" >
                </form>
         @endforeach    
   
@endsection
