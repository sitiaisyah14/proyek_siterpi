@extends('layouts.app')
@section('title', 'Stok Obat')
@section('content')
    <div class="pagetitle">
        <h1>Obat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active">Stok Obat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Transaksi Data Stok Obat</h5>
            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('historydrug.store') }}">
                @csrf
                <div class="col-4">
                    <label for="inputAddress" class="form-label">Nama User</label>
                    <input type="hidden" value="{{ Auth::id() }}" name="user_id">
                    <input type="text" class="form-control" id="user_id" value="{{ Auth::user()->name }}" readonly>
                </div>
                <div class="col-4">
                    <label for="inputAddress" class="form-label">Nama Obat</label>
                    <select class="form-select" aria-label="Default select example" name="drug_id" id="drug_id" required>
                        <option value="">-- Pilih Nama Obat --</option>
                        @foreach ($drug as $data)
                            <option value="{{ $data->id }}" @if (old('drug_id') == $data->id) selected @endif>
                                {{ $data->nama_obat }}
                            </option>
                        @endforeach
                    </select>
                    @error('drug_id')
                        <small class="text-danger drug_id">{{ $message }}</small>
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
                        <input type="number" class="form-control" id="masuk" name="masuk" value="{{ old('masuk') }}"
                            required>
                            <span class="input-group-text" id="basic-addon1">Pcs</span>
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
                            value="{{ old('keluar') }}" required>
                        <span class="input-group-text" id="basic-addon1">Pcs</span>
                        @error('keluar')
                            <small class="text-danger keluar">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('historydrug.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form><!-- End Multi Columns Form -->
        </div>
    </div>
@endsection
@section('js')
    <script>
        $('#drug-nav').removeClass('collapsed');
        $('.sidebar-drug').addClass('show');
        $('#menu-detail-drug').addClass('active');
    </script>
@endsection
