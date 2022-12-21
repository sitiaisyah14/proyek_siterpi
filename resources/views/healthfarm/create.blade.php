@extends('layouts.app')
@section('title', 'Rekap Kesehatan Sapi')
@section('content')
    <div class="pagetitle">
        <h1>Tambah Rekap Kesehatan Sapi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item">Master Sapi</a></li>
                <li class="breadcrumb-item active">Rekap Kesehatan Sapi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Tambah Data Rekap Kesehatan</h5>
            <!-- Multi Columns Form -->
            <form class="row g-3" method="POST" action="{{ route('healthfarm.store') }}">
                @csrf
                <div class="col-4">
                    <label for="inputAddress" class="form-label">Nomor Sapi</label>
                    <select class="form-select" aria-label="Default select example" name="farm_id" id="farm_id" required>
                        <option value="">-- Pilih Nomor Sapi --</option>
                        @foreach ($farm as $data)
                            <option value="{{ $data->id }}" @if (old('farm_id') == $data->id) selected @endif>
                                {{ $data->nis }}
                            </option>
                        @endforeach
                    </select>
                    @error('farm_id')
                        <small class="text-danger farm_id">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="tanggal" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal"
                            value="{{ old('tanggal') }}" required>
                        @error('tanggal')
                            <small class="text-danger tanggal">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="col-4">
                    <label for="inputAddress" class="form-label">Keterangan Penyakit</label>
                    <br>
                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="5" >{{old('keterangan')}} </textarea>
                    @error('keterangan')
                    <small class="text-danger keterangan">{{ $message }}</small>
                    @enderror
                </div>
                <hr>

                <div class="row" id="row">
                    <div class="col-md-4" >
                        <div class="mb-3">
                            <label for="obat" class="form-label">Pilih Obat</label>
                            <select class="form-select" aria-label="Default select example" name="drug_id[]" id="drug_id" required>
                                <option value="">-- Pilih Nama Obat --</option>
                                @foreach ($drug as $data)
                                    <option value="{{ $data->id }}" @if (old('drug_id') == $data->id) selected @endif>
                                        {{ $data->nama_obat}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="obat" class="form-label">Jumlah Obat</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah[]" min="1"
                                value="{{ old('jumlah') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="obat" class="form-label"></label>
                        <div class="d-flex mt-2">
                            <div class="col-md-6"><button class="btn btn-danger" id="deleteRow">Hapus Obat</button></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="newinput"></div>
                </div>
                <div class="col-md-4"><button class="btn btn-primary" id="rowAdder">Tambah Obat</button></div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    <a href="{{ route('healthfarm.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form><!-- End Multi Columns Form -->
        </div>
    </div>
@endsection
@section('js')
    <script type="text/javascript">
        // $('#feed-nav').removeClass('collapsed');
        // $('.sidebar-feed').addClass('show');
        // $('#menu-detail-feed').addClass('active');
        $('#menu-health-farm').removeClass('collapsed');

        //addrow
        $('#rowAdder').click(function() {
            newRowAdd =
            '<div class="row" id="row">'+
            '<div class="col-md-4">' +
                    '<div class="mb-3">' +
                        '<label for="obat" class="form-label">Pilih Obat</label>'+
                        '<select class="form-select" aria-label="Default select example" name="drug_id[]" id="drug_id" required>'+
                            '<option value="">-- Pilih Nama Obat --</option>'+
                            '@foreach ($drug as $data)' +
                                '<option value="{{ $data->id }}" @if (old('drug_id') == $data->id) selected @endif>' +
                                    '{{ $data->nama_obat}}' +
                                '</option>' +
                            '@endforeach' +
                        '</select>' +
                   '</div>'+
                '</div>'+
                '<div class="col-md-3">'+
                    '<div class="mb-3">'+
                        '<label for="obat" class="form-label">Jumlah Obat</label>'+
                        '<input type="number" class="form-control" id="jumlah" name="jumlah[]" min="1" value="{{ old('jumlah') }}" required>'+
                    '</div>'+
                '</div>'+
                '<div class="col-md-4">'+
                    '<label for="obat" class="form-label"></label>'+
                    '<div class="d-flex mt-2">'+
                        '<div class="col-md-6"><button class="btn btn-danger" id="deleteRow">Hapus Obat</button></div>'+
                    '</div>'+
                '</div>' +
            '</div>'

                $('#newinput').append(newRowAdd);
        });
        $("body").on('click','#deleteRow', function () {
            $(this).parents('#row').remove();
        })
    </script>
@endsection
