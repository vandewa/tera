<div class="container">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="row">
            <!-- Tanggal Pemeriksaan -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tanggal_pemeriksaan">Tanggal Pemeriksaan</label>
                    <input type="date" id="tanggal_pemeriksaan" class="form-control"
                        wire:model="pemeriksaan.tanggal_pemeriksaan">
                    @error('pemeriksaan.tanggal_pemeriksaan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Hasil ST -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="hasil_st">Hasil</label>
                    <select id="hasil_st" class="form-control" wire:model.live="pemeriksaan.hasil_st">
                        <option value="">Pilih Hasil</option>
                        @foreach ($hasil as $item)
                            <option value="{{ $item->com_cd }}">{{ $item->code_nm }}</option>
                        @endforeach
                    </select>
                    @error('pemeriksaan.hasil_st')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        @if ($tampilAlasn)
            <div class="row">
                <!-- Hasil Keterangan -->
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="hasil_keterangan">Hasil Keterangan</label>
                        <textarea id="hasil_keterangan" class="form-control" rows="2" wire:model.defer="pemeriksaan.hasil_keterangan"></textarea>
                        @error('pemeriksaan.hasil_keterangan')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        @endif

        <div class="row">
            <!-- Pegawai Berhak and Penandatanganan -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pegawai_berhak_id">Pegawai Berhak</label>
                    <select id="pegawai_berhak_id" class="form-control"
                        wire:model.defer="pemeriksaan.pegawai_berhak_id">
                        <option value="">Pilih Pegawai Berhak</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('pemeriksaan.pegawai_berhak_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="penandatanganan_id">Penandatanganan</label>
                    <select id="penandatanganan_id" class="form-control"
                        wire:model.defer="pemeriksaan.penandatanganan_id">
                        <option value="">Pilih Penandatanganan</option>
                        @foreach ($penandatangan as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('pemeriksaan.penandatanganan_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="upload_cerapan">Upload Cerapan</label>
            <div class="input-group">
                <input type="file" id="upload_cerapan" class="form-control" wire:model="upload_cerapan">
                <div class="input-group-append">
                    @if ($file_name)
                        <a href="{{ route('helper.show-picture', ['path' => $file_name]) }}"
                            class="btn btn-outline-secondary" target="_blank">
                            <i class="fa fa-download"></i> {{ $file_name }}
                        </a>
                    @endif
                </div>
            </div>
            @error('upload_cerapan')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="upload_cerapan">Metode</label>
                <div class="input-group">
                    <textarea name="" class="form-control" wire:model="pemeriksaan.metode" rows="3"></textarea>
                </div>
                @error('pemeriksaan.metode')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <label for="upload_cerapan">Telusuran</label>
                <div class="input-group">
                    <textarea name="" class="form-control" wire:model="pemeriksaan.telusuran" rows="2"></textarea>
                </div>
                @error('pemeriksaan.telusuran')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
        </div>

        <div class="mt-3 row">
            <!-- Standar Inputs -->
            <div class="col-md-12">
                <div class="form-group">
                    <label>Standar</label>
                    @foreach ($standars as $index => $standar)
                        <div class="mb-3 input-group">
                            <input class="form-control" wire:model.defer="standars.{{ $index }}.nama"
                                id="standar">
                            </input>
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="button"
                                    wire:click="removeStandar({{ $index }})">Hapus</button>
                            </div>
                        </div>
                    @endforeach

                    <button type="button" class="btn btn-info btn-sm" wire:click="addStandar">Tambah Standar</button>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Petugas Inputs -->
            <div class="col-md-12">
                <div class="form-group">
                    <label>Petugas</label>
                    @foreach ($petugas as $index => $petugas)
                        <div class="mb-3 input-group">
                            <select class="form-control" wire:model.defer="petugas.{{ $index }}.user_id"
                                id="petugas">
                                <option value="">Pilih Petugas</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="button"
                                    wire:click="removePetugas({{ $index }})">Hapus</button>
                            </div>
                        </div>
                    @endforeach

                    <button type="button" class="btn btn-info btn-sm" wire:click="addPetugas">Tambah
                        Petugas</button>
                </div>
            </div>
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Simpan</button>
        </div>

    </form>
</div>

@push('js')
    <script>
        document.addEventListener('livewire:load', function() {
            // Fungsi untuk tombol tambah standar
            document.getElementById('standar').addEventListener('click', function() {
                // Logika untuk menambah standar
            });
            document.getElementById('petugas').addEventListener('click', function() {
                // Logika untuk menambah standar
            });
        });
    </script>
@endpush
