@extends('layouts.app')
@section('title', 'Stok Pakan')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatable/datatables.min.css') }}">
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Stok Pakan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item">Master Pakan</a></li>
                <li class="breadcrumb-item active">Stok Pakan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Transaksi Stok Pakan</h5>
                        <a href="{{ route('historyfeed.create') }}" class="btn btn-primary mb-4"> Keluar/Masuk Stok Pakan</a>
                        <!-- Table with stripped rows -->
                        <div class="row align-items-end mb-5">
                            <div class="col-md-3">
                                <div class="">
                                    <label for="floatingSelectGrid">Pilih Nama Pakan</label>
                                    <select class="form-select" id="feed_id" name="feed_id">
                                        <option value="">-- Pilih Nama Pakan --</option>
                                        @foreach ($feed as $data)
                                            <option value="{{ $data->id }}"
                                                @if (old('feed_id') == $data->id) selected @endif>{{ $data->nama_pakan }}
                                            </option>
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
                                    onclick="printData(`{{ route('feedhistory.pdf') }}`)">
                                    <i class="bi bi-file-earmark-pdf text-lg me-1"></i>
                                    PDF
                                </a>
                                <a href="javascript:;" class="btn mb-0 btn-success text-sm"
                                    onclick="printData(`{{ route('feedhistory.excel') }}`)">
                                    <i class="bi bi-file-earmark-excel text-lg"></i>
                                    Excel
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="hisfeedData" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Pakan</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Masuk</th>
                                        <th scope="col">Keluar</th>
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
        $('#feed-nav').removeClass('collapsed');
        $('.sidebar-feed').addClass('show');
        $('#menu-detail-feed').addClass('active');
        filterDate();

        function filterDate(params) {
            $('#hisfeedData').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "destroy": true,
                "ajax": {
                    "url": base_url + "/hisfeed-data",
                    "dataType": "json",
                    "type": "post",
                    "data": {
                        _token: web_token,
                        from_date: $('#from_date').val(), //request:value
                        to_date: $('#to_date').val(),
                        feed_id: $('#feed_id').val(),
                    }
                },
                "columns": [{
                        "data": "DT_RowIndex",
                        "name": "id"
                    },
                    {
                        "data": "feed_name",
                        "name": "feeds.nama_pakan"
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
            var feed_id = document.getElementById('feed_id').value;

            window.open(url + '?from_date=' + from_date + '&to_date=' + to_date + '&feed_id=' + feed_id);
        }
    </script>
@endsection
