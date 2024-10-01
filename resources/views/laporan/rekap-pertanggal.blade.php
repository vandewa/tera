<html>

<head>
    <style>
        .center-text {
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="center-text">
        <span>Jumlah Pelayanan Tera/Tera Ulang</span> <br>
        <span>Unit Metrologi Legal</span><br>
        <span>Dinas Perdagangan, Koperasi, UKM Kab Wonosobo</span><br>
        <span>Januari - Maret 2024</span><br><br>
    </div>
    <table>
        <thead>
            <th>No</th>
            <th>UTTP</th>
            <th>Jumlah</th>
        </thead>
        <tbody>
            @foreach ($data as $list)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $list->nama }}</td>
                    <td>{{ $list->pengajuan_count }}</td>
                </tr>
            @endforeach
            <tr>
                <th colspan="2">TOTAL</th>
                <th>{{ $totalPengajuanCount }}</th>
            </tr>
        </tbody>
    </table><br><br><br>

    <div class="center-text">
        <span>Mengetahui</span><br>
        <span>Kepala Dinas Perdagangan, Koperasi, UKM</span><br>
        <span>Kabupaten Wonosobo</span><br><br><br><br>

        <span>KRISTIYANTO, SH </span><br>
        <span>Pembina Utama Muda</span><br>
        <span>NIP. 19641114 199003 1 006</span>
    </div>

</body>

</html>
