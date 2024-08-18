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
                    <label for="hasil_st">Hasil ST</label>
                    <select id="hasil_st" class="form-control" wire:model.defer="pemeriksaan.hasil_st">
                        <option value="">Select Hasil ST</option>
                        <option value="Completed">Completed</option>
                        <option value="Pending">Pending</option>
                        <option value="Failed">Failed</option>
                        <!-- Add other options as needed -->
                    </select>
                    @error('pemeriksaan.hasil_st')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Hasil Keterangan -->
            <div class="col-md-12">
                <div class="form-group">
                    <label for="hasil_keterangan">Hasil Keterangan</label>
                    <textarea id="hasil_keterangan" class="form-control" rows="4" wire:model.defer="pemeriksaan.hasil_keterangan"></textarea>
                    @error('pemeriksaan.hasil_keterangan')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Pegawai Berhak and Penandatanganan -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pegawai_berhak_id">Pegawai Berhak</label>
                    <select id="pegawai_berhak_id" class="form-control"
                        wire:model.defer="pemeriksaan.pegawai_berhak_id">
                        <option value="">Select Pegawai Berhak</option>
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
                        <option value="">Select Penandatanganan</option>
                        @foreach ($users as $user)
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
                        <a href="{{ Storage::url($file_name) }}" class="btn btn-outline-secondary" target="_blank">
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
            <!-- Standar Inputs -->
            <div class="col-md-12">
                <div class="form-group">
                    <label>Standar</label>
                    @foreach ($standars as $index => $standar)
                        <div class="mb-3 input-group">
                            <select class="form-control" wire:model.defer="standars.{{ $index }}.user_id">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="button"
                                    wire:click="removeStandar({{ $index }})">Remove</button>
                            </div>
                        </div>
                    @endforeach
                    <button type="button" class="btn btn-primary" wire:click="addStandar">Add Standar</button>
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
                            <select class="form-control" wire:model.defer="petugas.{{ $index }}.user_id">
                                <option value="">Select User</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <div class="input-group-append">
                                <button class="btn btn-danger" type="button"
                                    wire:click="removePetugas({{ $index }})">Remove</button>
                            </div>
                        </div>
                    @endforeach
                    <button type="button" class="btn btn-primary" wire:click="addPetugas">Add Petugas</button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
