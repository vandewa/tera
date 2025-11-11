<!DOCTYPE html>
<html>
<head>
    <title>Rekap Pelayanan Sidang Tera/Tera Ulang {{ $tahun }}</title>
    <style>
        .center-text {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            font-size: 14pt;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background-color: #d9d9d9;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="center-text">
        REKAP PELAYANAN SIDANG TERA/TERA ULANG
    </div>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>TANGGAL</th>
                <th>LOKASI</th>
                <th>PEMILIK</th>
                <th>NAMA PERUSAHAAN</th>
                <th>NO HP</th>
                <th>UTTP</th>
                <th>JUMLAH</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                @php
                    $uttpCount = $item['uttpCounts']->count();
                    $firstRow = true;
                @endphp
                @if($uttpCount > 0)
                    @foreach ($item['uttpCounts'] as $uttpNama => $uttpData)
                        <tr>
                            @if ($firstRow)
                                <td rowspan="{{ $uttpCount }}">{{ $item['no'] }}</td>
                                <td rowspan="{{ $uttpCount }}">{{ \Carbon\Carbon::parse($item['tanggal_mulai'])->format('d/m/Y') }}</td>
                                <td rowspan="{{ $uttpCount }}" style="text-align:left;">{{ $item['lokasi'] }}</td>
                                <td rowspan="{{ $uttpCount }}" style="text-align:left;">{{ $item['user_name'] }}</td>
                                <td rowspan="{{ $uttpCount }}" style="text-align:left;">{{ $item['nama_usaha'] }}</td>
                                <td rowspan="{{ $uttpCount }}">{{ $item['wa'] }}</td>
                                @php $firstRow = false; @endphp
                            @endif
                            <td style="text-align:left;">{{ $uttpNama }}</td>
                            <td>{{ $uttpData->total }}</td>
                            @if ($loop->first)
                                <td rowspan="{{ $uttpCount }}"><b>{{ $item['total'] }}</b></td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>{{ $item['no'] }}</td>
                        <td>{{ \Carbon\Carbon::parse($item['tanggal_mulai'])->format('d/m/Y') }}</td>
                        <td style="text-align:left;">{{ $item['lokasi'] }}</td>
                        <td style="text-align:left;">{{ $item['user_name'] }}</td>
                        <td style="text-align:left;">{{ $item['nama_usaha'] }}</td>
                        <td>{{ $item['wa'] }}</td>
                        <td style="text-align:left;">-</td>
                        <td>0</td>
                        <td><b>0</b></td>
                    </tr>
                @endif
            @endforeach
            <tr>
                <th colspan="8">TOTAL KESELURUHAN</th>
                <th>{{ $data->sum('total') }}</th>
            </tr>
        </tbody>
    </table>
</body>
</html>
