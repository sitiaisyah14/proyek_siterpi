@extends('layouts.app')
@section('title', 'Pakan')
@section('content')
    <div class="pagetitle">
        <h1>Pakan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Pakan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah Data Pakan Baru</h5>
            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('feed.store') }}">
                @csrf
                <div class="col-4">
                    <label for="inputAddress" class="form-label">Nama Pakan</label>
                    <input type="text" class="form-control" name="nama_pakan" id="nama_pakan" value="{{old('nama_pakan')}}" required>
                    @error('nama_pakan')
                    <small class="text-danger nama_pakan">{{ $message }}</small>
                    @enderror
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('feed.index')}}" class="btn btn-secondary">Kembali</a>
                </div>
            </form><!-- End Multi Columns Form -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#feed-nav').removeClass('collapsed');
        $('.sidebar-feed').addClass('show');
        $('#menu-feed').addClass('active');
    </script>
@endsection
