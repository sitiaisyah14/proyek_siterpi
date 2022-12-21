@extends('layouts.app')
@section('title', 'Pakan')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatable/datatables.min.css') }}">
@endsection
@section('content')
    <div class="pagetitle">
        <h1>Pakan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item">Master Pakan</a></li>
                <li class="breadcrumb-item active">Pakan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data Pakan</h5>
                        <a href="{{ route('feed.create') }}" class="btn btn-primary mb-4">Tambah Data Pakan Baru</a>
                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table" id="feedData" width="100%" >
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Pakan</th>
                                        <th scope="col">Stok Akhir</th>
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
        $('#menu-feed').addClass('active');
        filterDate();
        function filterDate(params) {
            $('#feedData').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "destroy": true,
                "ajax": {
                    "url": base_url + "/feed-data",
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
                        "data": "nama_pakan"
                    },
                    {
                        "data": "stok_akhir"
                    },
                    {
                        "data": "options"
                    }
                ]
            });
        }
    </script>
@endsection
