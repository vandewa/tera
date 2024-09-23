<div>
    <style>
        /* Add a gradient background to the card */
        .card-header {
            background: linear-gradient(135deg, #6f42c1, #007bff);
            color: white;
        }

        /* Add shadow to the card */
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Style buttons with more vibrant colors */
        .btn-custom-approve {
            background-color: #28a745;
            color: white;
        }

        .btn-custom-reject {
            background-color: #dc3545;
            color: white;
        }

        /* Add some space between buttons */
        .card-footer button {
            margin-left: 10px;
        }
    </style>
    @if ($data['pengajuan_st'] == 'PENGAJUAN_ST_01')
        <div>

            <div class="card">
                <div class="text-center card-header">
                    <h5><i class="bi bi-file-earmark-check-fill"></i> Persetujuan Permohonan Tera</h5>
                </div>
                <div class="card-body">
                    <h6 class="card-title">Detail Permohonan</h6>
                    <p class="card-text">Apakah anda akan menyetujui permohonan berikut?</p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><strong>Nomor Permohonan:</strong> {{ $data->order_no ?? '-' }}</li>
                        <li class="list-group-item"><strong>Pemohon:</strong> {{ $data->pemohon->name ?? '-' }}</li>
                        <li class="list-group-item"><strong>Alamat:</strong> {{ $data->pemohon->alamat ?? '-' }}</li>
                        <li class="list-group-item"><strong>Tanggal Pengajuan:</strong>
                            {{ $data->created_at->locale('id')->translatedFormat('d F Y') }}
                        </li>
                        <li class="list-group-item"><strong>Jenis Pengajuan:</strong>
                            {{ $data->jenisPengajuan->code_nm ?? '-' }}

                            @if ($data->jenisPengajuan->com_cd == 'PENGAJUAN_TP_02')
                                ({{ $data->alamat ?? '' }})
                            @endif
                        </li>
                    </ul>
                </div>
                <div class="card-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-custom-reject" wire:click='tolak'><i
                            class="fas fa-times-circle mr-1"></i>Tolak</button>
                    <button type="button" class="btn btn-custom-approve" wire:click='terima'>
                        <i class="fas fa-check-circle mr-1"></i>
                        Terima
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
