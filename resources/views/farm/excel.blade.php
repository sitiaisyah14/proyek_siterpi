<table width="100%">
    <tbody>
        <tr>
            <td colspan="6" rowspan="5"  style="text-align: center">
                <p><b>{{ config('app.name') }}</b></p>
                <p class="fs mb-0">{{ config('app.address') }} Tlp. {{ config('app.phone') }}</p>
                <p><b>Laporan Data Sapi</b></p>
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
        <tr>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">No</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">NIS</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Jenis Kelamin</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Status</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Kondisi</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($farm as $data)
            <tr>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $loop->iteration }}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->nis }}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->jk }}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->status}}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->kondisi }}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->keterangan}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
