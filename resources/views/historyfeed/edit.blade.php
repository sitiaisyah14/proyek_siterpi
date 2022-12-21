@extends('layouts.app')
@section('title', 'Stok Pakan')
@section('content')
    <div class="pagetitle">
        <h1>Pakan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Stok Pakan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Data Stok Pakan</h5>
            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('historyfeed.update',$feedhis->id) }}">
                @method('PUT')
                @csrf
                <div class="col-4">
                    <label for="inputAddress" class="form-label">Nama User</label>
                    <input type="hidden" value="{{ Auth::id() }}" name="user_id">
                    <input type="text" class="form-control" id="user_id" value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="col-4">
                    <label for="inputAddress" class="form-label">Nama Pakan</label>
                    <select class="form-select" aria-label="Default select example" name="feed_id" id="feed_id" required>
                        <option value="">-- Pilih Nama Pakan --</option>
                        @foreach ($feed as $data)
                        <option value="{{ $data->id }}" @if ($feedhis->feed_id == $data->id) selected @endif>
                            {{ $data->nama_pakan }}
                        </option>
                    @endforeach
                    </select>
                    @error('feed_id')
                        <small class="text-danger feed_id">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="{{ date("Y-m-d") }}" required>
                        @error('tanggal')
                            <small class="text-danger tanggal">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="masuk" class="form-label">Masuk</label><br>
                    <small>Isi 0 jika tidak ada data yang masuk</small>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" id="masuk" name="masuk" value="{{ $feedhis->masuk }}"
                            required>
                            <span class="input-group-text" id="basic-addon1">Kg</span>
                        @error('masuk')
                            <small class="text-danger masuk">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4">
                    <label for="keluar" class="form-label">Keluar</label><br>
                    <small>Isi 0 Jika tidak ada data yang keluar</small>
                    <div class="input-group mb-3">
                        <input type="number" class="form-control" id="keluar" name="keluar"
                            value="{{ $feedhis->keluar }}" required>
                            <span class="input-group-text" id="basic-addon1">Kg</span>
                        @error('keluar')
                            <small class="text-danger keluar">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('historyfeed.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form><!-- End Multi Columns Form -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#feed-nav').removeClass('collapsed');
        $('.sidebar-feed').addClass('show');
        $('#menu-detail-feed').addClass('active');
    </script>
@endsection
