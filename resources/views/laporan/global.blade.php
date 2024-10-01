<!DOCTYPE html>
<html>

<head>
    <title>UTTP Report</title>
    {{-- <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style> --}}
    <style>
        .center-text {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="center-text">
        <span>Unit Metrologi Legal</span><br>
        <span>Dinas Perdagangan, Koperasi, UKM Kab Wonosobo</span><br>
        <span>Tahun {{ request()->tahun }}</span><br><br>
    </div>

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>JENIS UTTP</th>
                @foreach (range(1, 12) as $month)
                    <th>{{ DateTime::createFromFormat('!m', $month)->format('M') }}</th>
                @endforeach
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($monthlyData[1] as $index => $uttp)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $uttp->nama }}</td>
                    @php $totalRowCount = 0; @endphp
                    @foreach (range(1, 12) as $month)
                        @php
                            $count = $monthlyData[$month][$index]->pengajuan_count ?? 0;
                            $totalRowCount += $count;
                        @endphp
                        <td>{{ $count > 0 ? $count : '-' }}</td>
                    @endforeach
                    <td>{{ $totalRowCount }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="2">TOTAL</th>
                @foreach ($monthlyCounts as $month => $count)
                    <th>{{ $count }}</th>
                @endforeach
                <th>{{ $totalPengajuanCount }}</th>
            </tr>
        </tbody>
    </table>
</body>

</html>
