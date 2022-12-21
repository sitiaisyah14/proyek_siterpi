@extends('layouts.app')
@section('title', 'Sapi')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatable/datatables.min.css') }}">
@endsection
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
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Sapi</h5>
                        <a href="{{ route('farm.create') }}" class="btn btn-primary mb-4">Tambah Sapi</a>

                        <div class="row align-items-end mb-5">
                            <div class="col-md-3">
                                <div class="">
                                    <label for="floatingSelectGrid">Pilih Status</label>
                                    <select class="form-select" id="status" name="status">
                                        <option value="">-- Pilih Status --</option>
                                        <option value="Terjual"> Terjual</option>
                                        <option value="Belum Terjual"> Belum Terjual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <button class="btn mb-0 btn-primary" onclick="filterDate()">Cari</button>
                                <a href="javascript:;" class="btn mb-0 btn-danger text-sm"
                                    onclick="printData(`{{ route('farm.pdf') }}`)">
                                    <i class="bi bi-file-earmark-pdf text-lg me-1"></i>
                                    PDF
                                </a>
                                <a href="javascript:;" class="btn mb-0 btn-success text-sm"
                                    onclick="printData(`{{ route('farm.excel') }}`)">
                                    <i class="bi bi-file-earmark-excel text-lg"></i>
                                    Excel
                                </a>
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                       <div class="table-responsive">
                        <table class="table" id="farmData" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Tanggal Masuk</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Kondisi</th>
                                    <th scope="col">Keterangan</th>
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
        $('#menu-farm').removeClass('collapsed');
        filterDate();

        function filterDate(params) {
            $('#farmData').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "destroy": true,
                "ajax": {
                    "url": base_url + "/farm-data",
                    "dataType": "json",
                    "type": "post",
                    "data": {
                        _token: web_token,
                        status: $('#status').val(),
                    }
                },
                "columns": [{
                        "data": "DT_RowIndex",
                        "name": "id"
                    },
                    {
                        "data": "nis"
                    },
                    {
                        "data": "tanggal_masuk"
                    },
                    {
                        "data": "jk"
                    },
                    {
                        "data": "status"
                    },
                    {
                        "data": "kondisi"
                    },
                    {
                        "data": "keterangan"
                    },
                    {
                        "data": "options"
                    }
                ]
            });
        }

        function printData(url) {
            var status = document.getElementById('status').value;
            window.open(url + '?status=' + status);
        }
    </script>
@endsection
