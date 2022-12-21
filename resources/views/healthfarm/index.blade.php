@extends('layouts.app')
@section('title', 'Rekap Kesehatan Sapi')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatable/datatables.min.css') }}">
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Rekap Kesehatan Sapi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item">Master Sapi</a></li>
                <li class="breadcrumb-item active">Rekap Kesehatan Sapi</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Rekap Kesehatan Sapi</h5>
                        <a href="{{ route('healthfarm.create') }}" class="btn btn-primary mb-4">Tambah Rekap Kesehatan</a>
                        <!-- Table with stripped rows -->
                        <div class="row align-items-end mb-5">
                            <div class="col-md-3">
                                <div class="">
                                    <label for="floatingSelectGrid">Nomor Sapi</label>
                                    <select class="form-select" id="farm_id" name="farm_id">
                                        <option value="">-- Pilih Nomor Sapi --</option>
                                        @foreach ($farm as $data)
                                            <option value="{{ $data->id }}"
                                                @if (old('farm_id') == $data->id) selected @endif>{{ $data->nis}}
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
                                    onclick="printData(`{{ route('healthfarm.pdf') }}`)">
                                    <i class="bi bi-file-earmark-pdf text-lg me-1"></i>
                                    PDF
                                </a>
                                <a href="javascript:;" class="btn mb-0 btn-success text-sm"
                                    onclick="printData(`{{ route('healthfarm.excel') }}`)">
                                    <i class="bi bi-file-earmark-excel text-lg"></i>
                                    Excel
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table" id="healthfarmData" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIS</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Keterangan Penyakit</th>
                                        <th scope="col">Aksi</th>
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
        $('#menu-health-farm').removeClass('collapsed');
        // $('.sidebar-feed').addClass('show');
        // $('#menu-health-farm').addClass('active');
        filterDate();

        function filterDate(params) {
            $('#healthfarmData').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "destroy": true,
                "ajax": {
                    "url": base_url + "/healthfarm-data",
                    "dataType": "json",
                    "type": "post",
                    "data": {
                        _token: web_token,
                        from_date: $('#from_date').val(), //request:value
                        to_date: $('#to_date').val(),
                        farm_id: $('#farm_id').val(),
                    }
                },
                "columns": [{
                        "data": "DT_RowIndex",
                        "name": "id"
                    },
                    {
                        "data": "cow_name",
                        "name": "farms.nis"
                    },
                    {
                        "data": "tanggal"
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
            var from_date = document.getElementById('from_date').value;
            var to_date = document.getElementById('to_date').value;
            var farm_id = document.getElementById('farm_id').value;

            window.open(url + '?from_date=' + from_date + '&to_date=' + to_date + '&farm_id=' + farm_id);
        }
    </script>
@endsection

