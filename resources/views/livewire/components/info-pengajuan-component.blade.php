<div class="card">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h3 class="card-title">Info Permohonan</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p class="card-text">Nama Pemohon:
                    <span class="text-muted">{{ $items->pengajuan->user->name ?? '-' }}</span></h5>
                </p>
                <p class="card-text">Tanggal Pengajuan: <span
                        class="text-muted">{{ date('d-m-Y', strtotime($items->pengajuan->created_at)) }}</span>
                </p>
                <p class="card-text">Status:

                    @if ($items->hasil->com_cd == 'HASIL_ST_01')
                        <span class="badge badge-info">{{ $items->hasil->code_nm ?? '-' }}</span>
                    @elseif($items->hasil->com_cd == 'HASIL_ST_02')
                        <span class="badge badge-danger">{{ $items->hasil->code_nm ?? '-' }}</span>
                    @elseif($items->hasil->com_cd == 'HASIL_ST_03')
                        <span class="badge badge-warning">{{ $items->hasil->code_nm ?? '-' }}</span>
                    @endif

                </p>

                @if ($items->hasil->com_cd == 'HASIL_ST_02' || $items->hasil->com_cd == 'HASIL_ST_03')
                    <p class="card-text">Keterangan: <span
                            class="text-muted">{{ $items->hasil_keterangan ?? '' }}</span>
                    </p>
                @endif

                <p class="card-text">Cerapan:
                    <a href="{{ route('helper.show-picture', ['path' => $items->upload_cerapan]) }}"
                        class="btn btn-outline-secondary btn-sm" target="_blank">
                        <i class="fa fa-download"></i> Download
                    </a>
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

        <div class="row">

            <div class="col-md-4">
                <a href="{{ route('helper.generate-data', ['id' => $items->id, 'jenis_download' => 'formulir_permohonan']) }}"
                    class="btn btn-dark btn-block">
                    <i class="fas fa-download"></i> Formulir Permohonan
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('helper.generate-data', ['id' => $items->id, 'jenis_download' => 'tanda_terima']) }}"
                    class="btn btn-dark btn-block">
                    <i class="fas fa-download"></i> Kartu Order
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('helper.generate-data', ['id' => $items->id, 'jenis_download' => 'skhp']) }}"
                    class="btn btn-dark btn-block">
                    <i class="fas fa-download"></i> Surat Keterangan (SKHP)
                </a>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h3 class="card-title">Upload Dokumen TTE</h3>
            </div>

            <div class="card-body">
                <form wire:submit.prevent="save">
                    <!-- Tanggal Pemeriksaan -->
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-md-2 col-form-label">Kartu Order</label>
                        <div class="col-md-7">
                            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-cancel="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <input type="file" wire:model="kartuOrder" class="form-control">
                                @error('kartuOrder')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                                <div x-show="uploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                    <span x-text="progress"><!-- Will output: "bar" -->
                                    </span> %
                                </div>
                            </div>
                        </div>
                        <div>
                            <div wire:loading wire:target="save">
                                <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                            </div>
                        </div>

                        @if ($pathKartuOrder)
                            <div class="col-md-3">
                                <a href="{{ route('helper.show-picture', ['path' => $pathKartuOrder->path]) }}"
                                    class="btn btn-outline-secondary btn-sm" target="_blank">
                                    <i class="fa fa-download"></i> Lihat Kartu Order
                                </a>
                            </div>
                        @endif

                    </div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-md-2 col-form-label">SKHP</label>
                        <div class="col-md-7">
                            <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
                                x-on:livewire-upload-finish="uploading = false"
                                x-on:livewire-upload-cancel="uploading = false"
                                x-on:livewire-upload-error="uploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress">
                                <input type="file" wire:model="skhp" class="form-control">
                                @error('skhp')
                                    <span class="form-text text-danger">{{ $message }}</span>
                                @enderror
                                <div x-show="uploading">
                                    <progress max="100" x-bind:value="progress"></progress>
                                    <span x-text="progress"><!-- Will output: "bar" -->
                                    </span> %
                                </div>
                            </div>
                        </div>
                        <div>
                            <div wire:loading wire:target="save">
                                <i class="fa fa-spinner fa-spin" style="font-size:24px"></i>
                            </div>
                        </div>

                        @if ($pathSkhp)
                            <div class="col-md-3">
                                <a href="{{ route('helper.show-picture', ['path' => $pathSkhp->path]) }}"
                                    class="btn btn-outline-secondary btn-sm" target="_blank">
                                    <i class="fa fa-download"></i> Lihat SKHP
                                </a>
                            </div>
                        @endif

                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary btn-block"><i
                                class="fas fa-save mr-2"></i>Simpan Dokumen</button>
                    </div>

                    <hr>

                    <div class="mt-3">
                        <a class="btn btn-danger btn-block" wire:click="finish">
                            <i class="fas fa-check mr-2"></i>
                            Selesaikan Permohonan
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>
