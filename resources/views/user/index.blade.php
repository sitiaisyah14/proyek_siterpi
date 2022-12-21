@extends('layouts.app')
@section('title', 'User')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/vendor/datatable/datatables.min.css') }}">
@endsection
@section('content')
    <div class="pagetitle">
        <h1>User</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                <li class="breadcrumb-item active">User</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data User</h5>
                        <a href="{{ route('user.create') }}" class="btn btn-primary mb-4">Tambah User</a>


                        <!-- Table with stripped rows -->
                        <div class="table-responsive">
                            <table class="table" id="userData" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Posisi</th>
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
        $('#menu-user').removeClass('collapsed');
        filterDate();
        function filterDate(params) {
            $('#userData').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "destroy": true,
                "ajax": {
                    "url": base_url + "/user-data",
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
                        "data": "foto"
                    },
                    {
                        "data": "name"
                    },
                    {
                        "data": "username"
                    },
                    {
                        "data": "position"
                    },
                    {
                        "data": "options"
                    }
                ]
            });
        }

    </script>
@endsection
