<table width="100%">
    <tbody>
        <tr>
            <td colspan="6" rowspan="5"  style="text-align: center">
                <p><b>{{ config('app.name') }}</b></p>
                <p class="fs mb-0">{{ config('app.address') }} Tlp. {{ config('app.phone') }}</p>
                <p><b>Laporan Data Pegawai</b></p>
            </td>
        </tr>
    </tbody>
</table>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">No</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">NIP</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Nama</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Jenis Kelamin</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Tempat Lahir</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Tanggal Lahir</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($employee as $data)
            <tr>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $loop->iteration }}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->nip }}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->nama }}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->getJenisKelamin()}}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->tempat_lahir }}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->tgl_lahir}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
