<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="card-title">Info Permohonan</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="card-text">Nama Pemohon: <span
                        class="text-muted">{{ $items->pengajuan->user->name ?? '-' }}</span></h5>
                <p class="card-text">Tanggal Pengajuan: <span
                        class="text-muted">{{ date('d-m-Y', strtotime($items->pengajuan->created_at)) }}</span></p>
                <p class="card-text">Status: <span class="badge badge-info">{{ $items->hasil->code_nm ?? '-' }}</span>
                </p>
                <p class="card-text">Metode: <span class="text-muted">{{ $items->metode }}</span></p>
                <p class="card-text">Telusuran: <span class="text-muted">{{ $items->telusuran }}</span></p>

            </div>

            <div class="col-md-6">

                <p class="card-text">Pegawai Berhak:
                    <span class="text-muted">{{ $items->berhak->name ?? '' }}</span>
                </p>

                <p class="card-text">Penandatangan:
                    <span class="text-muted">{{ $items->penandatangan->name ?? '' }}</span>
                </p>

                <div class="row">
                    <p class="mt-2 mr-3 ml-2">Standar:</p>
                    <ul class="list-unstyled">
                        @foreach ($items->standar as $standar)
                            <li><i class="fas fa-check-circle text-success"></i> {{ $standar->nama }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="row">
                    <p class="mt-2 mr-3 ml-2">Petugas:</p>
                    <ul class="list-unstyled">
                        @foreach ($items->petugas as $petugas)
                            <li><i class="fas fa-check-circle text-success"></i> {{ $petugas->user->name ?? '' }}</li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
        <hr>
        <a href="{{ route('helper.generate-data', ['id' => $items->id]) }}" class="btn btn-primary btn-block">
            <i class="fas fa-download"></i> Download Dokumen
        </a>
    </div>
</div>
