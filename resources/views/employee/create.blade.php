@extends('layouts.app')
@section('title', 'Pegawai')
@section('content')
<div class="pagetitle">
    <h1>Pegawai</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item active">Pegawai</li>
        </ol>
    </nav>
</div><!-- End Page Title -->
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Tambah Data Pegawai</h5>

        <!-- Multi Columns Form -->
        <form class="row g-3" method="POST" action="{{ route('employee.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Foto Pegawai</label>
                <input type="file" class="form-control" id="foto" name="foto" required value="{{old('foto')}}">
                @error('foto')
                <small class="text-danger foto">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Nama</label>
                <input type="text" class="form-control text-capitalize" id="nama" name="nama" value="{{old('nama')}}" required>
                @error('nama')
                <small class="text-danger nama">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Jenis Kelamin</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk" id="jk" value="L" checked=""  @if(old('jk')) checked @endif>
                    <label class="form-check-label" for="gridRadios1">Laki-Laki</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="jk" id="perempuan" value="P"  @if(old('jk')) checked @endif>
                    <label class="form-check-label" for="gridRadios1">Perempuan</label>
                </div>
                @error('jk')
                <small class="text-danger jk">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control text-capitalize" id="tempat_lahir" name="tempat_lahir" value="{{old('tempat_lahir')}}" required>
                @error('tempat_lahir')
                <small class="text-danger tempat_lahir">{{ $message }}</small>
                @enderror
            </div>
            <div class="col-md-4">
                <label for="inputAddress" class="form-label">Tanggal Lahir</label>
                <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="{{old('tgl_lahir')}}" required>
                @error('tgl_lahir')
                <small class="text-danger tgl_lahir">{{ $message }}</small>
                @enderror
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{route('employee.index')}}" class="btn btn-secondary">Kembali</a>
            </div>
        </form><!-- End Multi Columns Form -->
    </div>
</div>
@endsection
@section('js')
<script>
    $('#menu-employee').removeClass('collapsed');
</script>
@endsection
