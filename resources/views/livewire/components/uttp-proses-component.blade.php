<div>
    <h1>Data Pengajuan UTTP</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>UTTP Name</th>
                <th>No Seri</th>
                <th>Merek</th>
                <th>Tipe</th>
                <th>Kapasitas</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuanUttps as $pengajuanUttp)
                <tr>
                    <td>{{ $pengajuanUttp->id }}</td>
                    <td>{{ $pengajuanUttp->uttp ? $pengajuanUttp->uttp->nama : 'N/A' }}</td>
                    <td>{{ $pengajuanUttp->no_seri }}</td>
                    <td>{{ $pengajuanUttp->merek }}</td>
                    <td>{{ $pengajuanUttp->tipe }}</td>
                    <td>{{ $pengajuanUttp->kapasitas }}</td>
                    <td>{{ $pengajuanUttp->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
