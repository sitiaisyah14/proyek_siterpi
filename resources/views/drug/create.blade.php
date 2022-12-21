@extends('layouts.app')
@section('title', 'Obat')
@section('content')
    <div class="pagetitle">
        <h1>Obat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Obat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah Data Obat</h5>
            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('drug.store') }}">
                @csrf
                <div class="col-4">
                    <label for="inputAddress" class="form-label">Nama Obat</label>
                    <input type="text" class="form-control" name="nama_obat" id="nama_obat" value="{{old('nama_obat')}}" required>
                    @error('nama_obat')
                    <small class="text-danger nama_obat">{{ $message }}</small>
                    @enderror
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('drug.index')}}" class="btn btn-secondary">Kembali</a>
                </div>
            </form><!-- End Multi Columns Form -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#drug-nav').removeClass('collapsed');
        $('.sidebar-drug').addClass('show');
        $('#menu-drug').addClass('active');
    </script>
@endsection
