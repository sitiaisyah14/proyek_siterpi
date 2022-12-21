

<table width="100%">
    <tbody>
        <tr>
            <td colspan="6" rowspan="5"  style="text-align: center">
                <p><b>{{ config('app.name') }}</b></p>
                <p class="fs mb-0">{{ config('app.address') }} Tlp. {{ config('app.phone') }}</p>
                <p><b>Laporan Data Rekap Kesehatan</b></p>
            </td>
        </tr>
        <br><br>
    </tbody>
</table>
<br>
<table >
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
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Nomor Sapi</th>
            <th class="text-center fs" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Tanggal</th>
            <th class="text-center fs" colspan="3" style="border: 1px solid black; text-align: center;vertical-align:middle ;height: 40px; font-weight: bold;">Keterangan Penyakit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cowhealth as $data)
            <tr>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $loop->iteration }}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{{ $data->farm->nis }}</td>
                <td class="fs text-center" style="border: 1px solid black; text-align: center;">{!! date('d F Y',strtotime($data->tanggal)) !!}</td>
                <td class="fs text-center" colspan="3" style="border: 1px solid black; text-align: center;">{{ $data->keterangan }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
