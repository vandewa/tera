<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Info Permohonan</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="order-2 col-6 col-md-6 col-lg-6 order-md-1">
                    <h5 class="card-title">Nama Pemohon: {{ $items->pengajuan->user->name ?? '-' }}</h5>
                    <p class="card-text"></p>
                    <p class="card-text">Tanggal Pengajuan:
                        {{ date('d-m-Y', strtotime($items->pengajuan->created_at)) }}</p>
                    <p class="card-text">Status:
                        {{ $items->hasil->code_nm ?? '-' }}</p>
                    <p class="card-text">Tahapan:
                        {{ $items->metode }}</p>
                    <p class="card-text">Telusuran:
                        {{ $items->telusuran }}</p>
                    <h5>Standar: </h5>
                    @foreach ($items->standar as $standar)
                        <p class="card-text">
                            {{ $standar->nama }}</p>
                    @endforeach
                </div>
                <div class="order-2 col-6 col-md-6 col-lg-6 order-md-1">
                    <p class="card-text">Pegawai Berhak:
                        {{ $items->telusuran }}</p>
                    <p class="card-text">Penandatangan:
                        {{ $items->telusuran }}</p>
                    <h5>Petugas</h5>
                </div>
            </div>
            <hr>
            <a href="{{ route('helper.generate-data', ['id' => $items->id]) }}" class="btn btn-primary">Download
                Dokumen</a>
        </div>

    </div>
</div>
