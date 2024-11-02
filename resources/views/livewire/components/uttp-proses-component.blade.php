<div>
    <h5>Data Pengajuan UTTP</h5>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama UTTP</th>
                    <th>No Seri</th>
                    <th>Merek</th>
                    <th>Tipe</th>
                    <th>Kapasitas</th>
                    <th>Jumlah</th>
                    <th>Cerapan</th>
                    <th>Hasil</th>
                    <th>SKHP (TTE)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuanUttps as $pengajuanUttp)
                    <tr wire:key='{{ $pengajuanUttp->id }}'>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $pengajuanUttp->uttp ? $pengajuanUttp->uttp->nama : 'N/A' }}</td>
                        <td>{{ $pengajuanUttp->no_seri ?? '-' }}</td>
                        <td>{{ $pengajuanUttp->merek ?? '-' }}</td>
                        <td>{{ $pengajuanUttp->tipe ?? '-' }}</td>
                        <td>{{ $pengajuanUttp->kapasitas ?? '-' }}</td>
                        <td>{{ $pengajuanUttp->jumlah ?? '-' }}</td>
                        <td>
                            @if ($pengajuanUttp->cerapan_path)
                                <a href="{{ route('helper.show-picture', ['path' => $pengajuanUttp->cerapan_path]) }}"
                                    class="btn btn-outline-primary btn-sm" target="_blank">
                                    <i class="fa fa-download"></i>
                                </a>
                            @else
                                -
                            @endif

                        </td>
                        <td>{{ $pengajuanUttp->hasil->code_nm ?? '-' }}</td>

                        <td>
                            @if ($pengajuanUttp->skhp_path)
                                <a href="{{ route('helper.show-picture', ['path' => $pengajuanUttp->skhp_path]) }}"
                                    class="btn btn-outline-primary btn-sm" target="_blank">
                                    <i class="fa fa-download"></i>
                                </a>
                            @else
                                -
                            @endif

                        </td>

                        {{-- <td>
                            <div class="btn-group">
                                <button type="button" class="btn btn-default " data-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="fas fa-bars"></i>
                                </button>
                                <ul class="dropdown-menu" style="">
                                    <li>
                                        <a class="dropdown-item" wire:click.prevent="Add({{ $pengajuanUttp->id }})">
                                            <i class="far fa-edit mr-2"></i>Proses
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item"
                                            href="{{ route('helper.cetak-skhp', $pengajuanUttp->id) }}">
                                            <i class="fas fa-download mr-2"></i>Template SKHP
                                        </a>
                                    </li>
                            </div>
                        </td> --}}

                        <td>
                            <a class="btn btn-info btn-sm" wire:click.prevent="Add({{ $pengajuanUttp->id }})">
                                Proses
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Add/Edit Task Modal -->
    <div class="modal fade" id="modal-form" wire:ignore.self>
        <div class="modal-dialog modal-lg modal-dialog-centered custom-modal-two">
            <div class="modal-content">
                <div class="page-wrapper-new p-0">
                    <div class="content">
                        <div class="modal-header border-0 custom-modal-header">
                            <div class="page-title">
                                <h4>Proses</h4>
                            </div>
                            <button type="button" class="close" wire:click='cancelForm' aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body custom-modal-body">
                            <form wire:submit.prevent='save'>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Upload Cerapan</label>
                                            <input type="file"
                                                class="form-control @error('files') is-invalid @enderror"
                                                wire:model='files'>
                                            @error('files')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('files') }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div wire:loading wire:target="files">Uploading...</div>

                                        <div class="mb-3">
                                            <label class="form-label">Upload SKHP (TTE)</label>
                                            <input type="file"
                                                class="form-control @error('fileSkhp') is-invalid @enderror"
                                                wire:model='fileSkhp'>
                                            @error('fileSkhp')
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('fileSkhp') }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div wire:loading wire:target="fileSkhp">Uploading...</div>

                                        <div class="mb-3">
                                            <label class="form-label">Hasil</label>
                                            <select class="form-control" wire:model.live="form.hasil_st">
                                                <option value="">Pilih Hasil</option>
                                                @foreach ($hasil as $item)
                                                    <option value="{{ $item->com_cd }}">{{ $item->code_nm }}</option>
                                                @endforeach
                                            </select>
                                            @error('form.hasil_st')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        @if ($bukaKeterangan)
                                            <div class="mb-3">
                                                <label class="form-label">Keterangan</label>
                                                <input type="text" class="form-control"
                                                    wire:model="form.keterangan_hasil">
                                                @error('form.keterangan_hasil')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endif

                                    </div>

                                    <div class="modal-footer d-flex justify-content-end">
                                        <button type="button" class="btn btn-secondary me-2"
                                            wire:click='cancelForm'>Cancel</button>
                                        <button type="submit" class="btn btn-info">
                                            Submit
                                        </button>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add/Edit Task Modal -->

</div>

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Livewire.on('showModal', event => {

                let modalId = event.id;
                document.getElementById(modalId).classList.add('show');
                document.getElementById(modalId).style.display = 'block';
            });

            Livewire.on('hideModal', event => {
                let modalId = event.id;
                document.getElementById(modalId).classList.remove('show');
                document.getElementById(modalId).style.display = 'none';
            });
        });
    </script>
@endpush
