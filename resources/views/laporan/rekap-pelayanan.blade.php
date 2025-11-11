<!DOCTYPE html>
<html>
<head>
    <title>Rekap Pelayanan {{ $tahun }}</title>
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
        REKAP PELAYANAN {{ $tahun }}
    </div>

    <table>
        <thead>
            <tr>
                <th>ORDER</th>
                <th>TANGGAL</th>
                <th>PEMILIK</th>
                <th>LOKASI</th>
                <th>UTTP</th>
                <th>JUMLAH</th>
            </tr>
        </thead>
        <tbody>
            @php $rowNumber = 1; @endphp
            @foreach ($data as $pengajuan)
                @php
                    $itemCount = $pengajuan->uttpItem->count();
                    $firstItem = true;
                @endphp
                @if($itemCount > 0)
                    @foreach ($pengajuan->uttpItem as $item)
                        <tr>
                            @if ($firstItem)
                                <td rowspan="{{ $itemCount }}">{{ str_pad($rowNumber, 3, '0', STR_PAD_LEFT) }}'</td>
                                <td rowspan="{{ $itemCount }}">{{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d/m/Y') }}</td>
                                <td rowspan="{{ $itemCount }}" style="text-align:left;">{{ $pengajuan->user->name ?? '-' }}</td>
                                <td rowspan="{{ $itemCount }}" style="text-align:left;">{{ $pengajuan->alamat ?? '-' }}</td>
                                @php $firstItem = false; @endphp
                            @endif
                            <td style="text-align:left;">{{ $item->uttp->nama ?? '-' }}</td>
                            <td>{{ $item->jumlah ?? 0 }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>{{ str_pad($rowNumber, 3, '0', STR_PAD_LEFT) }}'</td>
                        <td>{{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d/m/Y') }}</td>
                        <td style="text-align:left;">{{ $pengajuan->user->name ?? '-' }}</td>
                        <td style="text-align:left;">{{ $pengajuan->alamat ?? '-' }}</td>
                        <td style="text-align:left;">-</td>
                        <td>0</td>
                    </tr>
                @endif
                @php $rowNumber++; @endphp
            @endforeach
        </tbody>
    </table>
</body>
</html>
