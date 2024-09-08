<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kartu Order Tera Ulang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .header-content {
            text-align: center;
            /* Center the text horizontally */
        }

        .header img {
            width: 80px;
            margin-right: 20px;
        }

        .header-content {
            text-align: left;
        }

        .title {
            text-align: center;
            font-weight: bold;
            background-color: yellow;
            margin-top: 10px;
            padding: 10px 0;
            font-size: 18px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 8px;
        }

        .order-info {
            width: 50%;
        }

        .bold {
            font-weight: bold;
        }

        .highlight {
            background-color: yellow;
            font-size: 20px;
            text-align: center;
        }

        .uttp-table {
            border: 1px solid #000;
        }

        .uttp-table th,
        .uttp-table td {
            border: 1px solid #000;
            text-align: center;
        }

        .keterangan {
            height: 100px;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="data:image/png;base64,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"
                alt="Logo Wonosobo">
            <div class="header-content">
                <h3>PEMERINTAH KABUPATEN WONOSOBO</h3>
                <h4>DINAS PERDAGANGAN, KOPERASI, USAHA KECIL DAN MENENGAH</h4>
                <p>Jl. T.Jogonegoro No.26 Wonosobo | (0286)321024</p>
            </div>
        </div>

        <div class="title">KARTU ORDER TERA / TERA ULANG</div>

        <table>
            <tr>
                <td class="order-info">
                    <p><span class="bold">Nomor Order: </span>026</p>
                    <p><span class="bold">Tanggal Order: </span>1 Januari 2023</p>
                    <p><span class="bold">Tgl Perkiraan Selesai: </span>7 Januari 2023</p>
                </td>
                <td>
                    <p><span class="bold">Nama Pemilik: </span>PT. Sri</p>
                    <p><span class="bold">Alamat: </span>Kretek Wonosobo</p>
                    <p><span class="bold">Telepon: </span>0857623586</p>
                </td>
            </tr>
        </table>

        <table class="uttp-table">
            <thead>
                <tr>
                    <th>Jenis UTTP</th>
                    <th>Kapasitas</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>TM</td>
                    <td>10 kg</td>
                    <td>2</td>
                </tr>
                <tr>
                    <td>CB</td>
                    <td>300 kg</td>
                    <td>1</td>
                </tr>
            </tbody>
        </table>

        <p><span class="bold">Keterangan: </span></p>
        <div class="keterangan"></div>

        <div class="footer">
            <p>Front Office</p>
            <p>(Aldin Wirawan, SE)</p>
        </div>
    </div>
</body>

</html>
