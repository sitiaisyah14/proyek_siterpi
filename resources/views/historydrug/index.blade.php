@extends('layouts.app')
@section('title', 'Stok Obat')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatable/datatables.min.css') }}">
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Stok Obat</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item">Master Obat</a></li>
                <li class="breadcrumb-item active">Stok Obat</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Transaksi Stok Obat</h5>
                        <a href="{{ route('historydrug.create') }}" class="btn btn-primary mb-4">Keluar / Masuk Stok Obat</a>
                        <!-- Table with stripped rows -->
                        <div class="row align-items-end mb-5">
                            <div class="col-md-3">
                                <div class="">
                                    <label for="floatingSelectGrid">Pilih Nama Obat</label>
                                    <select class="form-select" id="drug_id" name="drug_id">
                                        <option value="">-- Pilih Nama Obat --</option>
                                        @foreach ($drug as $data)
                                            <option value="{{ $data->id }}">{{ $data->nama_obat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="">
                                    <label for="floatingInputGrid">Tanggal Awal</label>
                                    <input type="date" class="form-control" placeholder="" value="{{ $from_date }}"
                                        name="from_date" id="from_date">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="">
                                    <label for="floatingInputGrid">Tanggal Akhir</label>
                                    <input type="date" class="form-control" placeholder="" value="{{ $to_date }}"
                                        name="to_date" id="to_date">
                                </div>
                            </div>
                            <div class="col">
                                <button class="btn mb-0 btn-primary" onclick="filterDate()">Cari</button>
                                <a href="javascript:;" class="btn mb-0 btn-danger text-sm"
                                    onclick="printData(`{{ route('drughistory.pdf') }}`)">
                                    <i class="bi bi-file-earmark-pdf text-lg me-1"></i>
                                    PDF
                                </a>
                                <a href="javascript:;" class="btn mb-0 btn-success text-sm"
                                    onclick="printData(`{{ route('drughistory.excel') }}`)">
                                    <i class="bi bi-file-earmark-excel text-lg"></i>
                                    Excel
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="hisdrugData" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Obat</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Masuk</th>
                                        <th scope="col">Keluar</th>
                                        <th scope="col">Keterangan Penggunaan</th>
                                        <th scope="col">Penanggung Jawab</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- End Table with stripped rows -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script src="{{ asset('admin/vendor/datatable/jquery-datatables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatable/datatables.min.js') }}"></script>
    <script>
        $('#drug-nav').removeClass('collapsed');
        $('.sidebar-drug').addClass('show');
        $('#menu-detail-drug').addClass('active');
        filterDate();

        function filterDate(params) {
            $('#hisdrugData').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "destroy": true,
                "ajax": {
                    "url": base_url + "/hisdrug-data",
                    "dataType": "json",
                    "type": "post",
                    "data": {
                        _token: web_token,
                        from_date: $('#from_date').val(), //request:value
                        to_date: $('#to_date').val(),
                        drug_id: $('#drug_id').val(),
                    }
                },
                "columns": [{
                        "data": "DT_RowIndex",
                        "name": "id"
                    },
                    {
                        "data": "drug_name",
                        "name": "drugs.nama_obat"
                    },
                    {
                        "data": "tanggal"
                    },
                    {
                        "data": "masuk"
                    },
                    {
                        "data": "keluar"
                    },
                    {
                        "data": "keterangan",
                        "name": "cow_health_histories.keterangan"
                    },
                    {
                        "data": "user_name",
                        "name": "users.name"
                    },
                    {
                        "data": "options"
                    }
                ]
            });
        }

        function printData(url) {
            var from_date = document.getElementById('from_date').value;
            var to_date = document.getElementById('to_date').value;
            var drugs = document.getElementById('drug_id').value;

            window.open(url + '?from_date=' + from_date + '&to_date=' + to_date + '&drug_id=' + drugs);
        }
    </script>
@endsection
