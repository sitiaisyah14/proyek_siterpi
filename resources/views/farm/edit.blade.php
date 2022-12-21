@extends('layouts.app')
@section('title', 'Sapi')
@section('content')
    <div class="pagetitle">
        <h1>Sapi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Sapi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Edit Data Sapi</h5>

            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('farm.update',$farm->id) }}">
                @method('PUT')
                @csrf
                <div class="col-md-3">
                    <label for="inputnis" class="form-label">NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis" value="{{ $farm->nis }}" readonly>
                    @error('nis')
                        <small class="text-danger error_nis">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="inputState" class="form-label">Jenis Kelamin</label>
                    <select class="form-select" name="jk" id="jk">
                        <option value=""> - Pilih Jenis Kelamin -</option>
                        <option value="Jantan" @if ($farm->jk == "Jantan") selected @endif> Jantan</option>
                        <option value="Betina" @if ($farm->jk == "Betina") selected @endif> Betina</option>
                    </select>
                    @error('jk')
                        <small class="text-danger jk">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="inputState" class="form-label">Status</label>
                    <select class="form-select" name="status" id="status">
                        <option value=""> - Pilih Status -</option>
                        <option value="Terjual" @if ($farm->status == "Terjual") selected @endif> Terjual</option>
                        <option value="Belum Terjual" @if ($farm->status == "Belum Terjual") selected @endif> Belum Terjual</option>
                    </select>
                    @error('status')
                        <small class="text-danger status">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label for="inputState" class="form-label">Kondisi</label>
                    <select class="form-select" name="kondisi" id="kondisi">
                        <option value=""> - Pilih Kondisi -</option>
                        <option value="Sehat" @if ($farm->kondisi == "Sehat") selected @endif> Sehat</option>
                        <option value="Sakit" @if ($farm->kondisi == "Sakit") selected @endif> Sakit</option>
                    </select>
                    @error('kondisi')
                        <small class="text-danger kondisi">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="inputAddress" class="form-label">Riwayat Penyakit</label>
                    <br>
                    <small class="text-danger">Kosongi bila kondisi sapi sehat</small>
                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5" >{{$farm->keterangan}} </textarea>
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
