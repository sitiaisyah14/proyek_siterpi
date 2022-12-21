<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Stok Obat</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <style>
        @page {
            margin: 24px;
        }

        .fs {
            font-size: 12px !important;
        }

        .table-bordered tr th,
        .table-bordered tr td {
            padding: 2px 3px !important;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tbody>
            <table align="center" style="border-collapse:collapse;">
                <td style="border-bottom:2px solid #000; text-align: center; width: 70px; width:70px">
                    <img src="{{public_path('admin/img/logo perusahaan.png')}}" alt="" style="width: 100px; height: 100px;">
                </td>
                <br>
                <td colspan="3" style="border-bottom:2px solid #000; text-align: center; width: 150px; width:650px">
                    <h3 class="mb-1 text-center">{{ config('app.name') }}</h3>
                    <p class="fs mb-0">{{ config('app.address') }}</p>
                    <p class="fs mb-0">No. Tlp. {{ config('app.phone') }}</p>
                </td>
            </table>
        <br>
            <h6 style="text-align: center;" > LAPORAN DATA STOK OBAT</h6>
            <table style="border: none" class="fs ml-5">
                <tr>
                    <td class="font-weight-bold">Tanggal </td>
                    <td>:</td>
                    <td>{{date('d F Y')}}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Waktu</td>
                    <td>:</td>
                    <td> @php
                        date_default_timezone_set('Asia/Jakarta'); // Zona Waktu indonesia
                        echo date('h:i:s a'); // menampilkan jam sekarang
                    @endphp</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Nama Obat</td>
                    <td>:</td>
                    <td> {{$drug->nama_obat ?? ''}}</td>
                </tr>
            </table>
        </tbody>
    </table>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th class="text-center fs">No</th>
                <th class="text-center fs">Nama User</th>
                <th class="text-center fs">Nama Obat</th>
                <th class="text-center fs">Tanggal</th>
                <th class="text-center fs">Masuk</th>
                <th class="text-center fs">Keluar</th>
                <th class="text-center fs">Keterangan Penggunaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($drughis as $data)
                <tr>
                    <td class="fs text-center">{{ $loop->iteration }}</td>
                    <td class="fs text-center">{{ $data->user->name }}</td>
                    <td class="fs text-center">{{ $data->drug->nama_obat}}</td>
                    <td class="fs text-center">{!! date('d F Y',strtotime($data->tanggal)) !!}</td>
                    <td class="fs text-center">{{ $data->masuk }} /pcs</td>
                    <td class="fs text-center">{{ $data->keluar}} /pcs</td>
                    @if ($data->cowhealth_id != null)
                        <td class="fs text-center"> No sapi {{$data->cowHealth->farm->nis}} - Penyakit {{ $data->cowHealth->keterangan}}</td>
                    @else
                    <td class="fs text-center"> - </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
