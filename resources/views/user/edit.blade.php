@extends('layouts.app')
@section('title', 'User')
@section('content')
    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Data User</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('user.update',$user->id) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="col-md-3">
                    <label for="inputFoto" class="form-label">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto" value="{{ $user->foto }}">
                    <img height="100px" width="100px" src="{{asset('storage/'.$user->foto)}}" alt="gambar profil" >
                    @error('foto')
                        <small class="text-danger error_foto">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="inputNama" class="form-label">Nama</label>
                    <input type="text" class="form-control text-capitalize" id="nama" name="name" value="{{ $user->name }}" required>
                    @error('name')
                        <small class="text-danger error_name">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="inputUsername" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}" required>
                    @error('username')
                        <small class="text-danger error_username">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label for="inputPassword" class="form-label">Ganti Password</label>
                    <input type="password" class="form-control" id="password" name="password" >
                    @error('password')
                        <small class="text-danger error_password">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="inputPassword" class="form-label">Konfirmasi Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" >
                </div>
                <div class="col-md-3">
                    <label for="inputPosition" class="form-label">Posisi</label>
                    <select class="form-select @error('position') is-invalid
                            @enderror" aria-label="Default select example" name="position" id="position" required>
                                <option @if($user->position =='Admin')selected @endif value="Admin">Admin</option>
                                <option @if($user->position =='Manager')selected @endif value="Manager" >Manager</option>
                    </select>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('user.index')}}" class="btn btn-secondary">Kembali</a>
                </div>
            </form><!-- End Multi Columns Form -->

        </div>
    </div>

@endsection
@section('js')
    <script>
        $('#menu-user').removeClass('collapsed');
    </script>
@endsection
