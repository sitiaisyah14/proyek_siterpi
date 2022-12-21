@extends('layouts.app')
@section('title', 'Pegawai')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatable/datatables.min.css') }}">
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Pegawai</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">Pegawai</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pegawai</h5>
                        <a href="{{ route('employee.create') }}" class="btn btn-primary mb-4">Tambah Pegawai</a>

                        <div class="row align-items-end mb-5">
                            <div class="col">
                                <a href=" {{ route('employee.pdf') }}" class="btn mb-0 btn-danger text-sm" id="cetakPdf" target="_blank">
                                    <i class="bi bi-file-earmark-pdf text-lg me-1"></i>
                                    PDF
                                </a>
                                <a href="{{ route('employee.excel')}}" class="btn mb-0 btn-success text-sm" id="cetakExcel" target="_blank">
                                    <i class="bi bi-file-earmark-excel text-lg"></i>
                                    Excel
                                </a>
                            </div>
                        </div>

                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table" id="employeeData">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">NIP</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Tempat Lahir</th>
                                        <th scope="col">Tanggal Lahir</th>
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
        $('#menu-employee').removeClass('collapsed');
        filterDate();

        function filterDate(params) {
            $('#employeeData').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "destroy": true,
                "ajax": {
                    "url": base_url + "/employee-data",
                    "dataType": "json",
                    "type": "post",
                    "data": {
                        _token: web_token,

                    }
                },
                "columns": [{
                        "data": "DT_RowIndex",
                        "name": "id"
                    },
                    {
                        "data": "nip"
                    },
                    {
                        "data": "foto"
                    },
                    {
                        "data": "nama"
                    },
                    {
                        "data": "jk"
                    },
                    {
                        "data": "tempat_lahir"
                    },
                    {
                        "data": "tgl_lahir"
                    },
                    {
                        "data": "options"
                    }
                ]
            });
        }

        // function printData(url) {
        //     var status = document.getElementById('status').value;
        //     window.open(url + '?status=' + status);
        // }
    </script>
@endsection
@section('js')
<script>
    $('#menu-employee').removeClass('collapsed');
</script>
@endsection
