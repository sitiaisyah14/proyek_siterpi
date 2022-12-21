@extends('layouts.app')
@section('title', 'Sapi')
@section('content')
    <div class="pagetitle">
        <h1>Sapi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Sapi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah Data Sapi</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('farm.store') }}">
                @csrf

                <div class="col-md-3">
                    <label for="inputState" class="form-label">Nomor Induk Sapi</label>
                    <input type="number" class="form-control" id="nis" name="nis" value="{{old('nis')}}" min="0">
                    @error('nis')
                        <small class="text-danger nis">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="inputState" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="{{ date("Y-m-d") }}">
                    @error('tanggal_masuk')
                        <small class="text-danger tanggal_masuk">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="inputState" class="form-label">Jenis Kelamin</label>
                    <select id="jk" class="form-select" name="jk">
                        <option value=""> - Pilih Jenis Kelamin -</option>
                        <option value="Jantan" @if (old('jk') == "Jantan") selected @endif> Jantan</option>
                        <option value="Betina" @if (old('jk') == "Betina") selected @endif> Betina</option>
                    </select>
                    @error('jk')
                        <small class="text-danger jk">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="inputState" class="form-label">Status</label>
                    <select class="form-select" name="status" id="status">
                        <option value=""> - Pilih Status -</option>
                        <option value="Terjual" @if (old('status') == "Terjual") selected @endif> Terjual</option>
                        <option value="Belum Terjual" @if (old('status') == "Belum Terjual") selected @endif> Belum Terjual</option>
                    </select>
                    @error('status')
                        <small class="text-danger status">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="inputState" class="form-label">Kondisi</label>
                    <select class="form-select" name="kondisi" id="kondisi">
                        <option value=""> - Pilih Kondisi -</option>
                        <option value="Sehat" @if (old('kondisi') == "Sehat") selected @endif> Sehat</option>
                        <option value="Sakit" @if (old('kondisi') == "Sakit") selected @endif> Sakit</option>
                    </select>
                    @error('kondisi')
                        <small class="text-danger kondisi">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-3">
                    <label for="inputAddress" class="form-label">Keterangan</label>
                    <br>
                    <small class="text-danger">Kosongi bila kondisi sapi sehat</small>
                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5" >{{old('keterangan')}} </textarea>
                    @error('keterangan')
                    <small class="text-danger keterangan">{{ $message }}</small>
                    @enderror
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{route('farm.index')}}" class="btn btn-secondary">Kembali</a>
                </div>
            </form><!-- End Multi Columns Form -->

        </div>
    </div>

@endsection
@section('js')
    <script>
        $('#menu-farm').removeClass('collapsed');
    </script>
@endsection
