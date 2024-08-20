<div>
    <div class="modal fade show" id="modal-default-cok"
        @if ($modalnya) style="display: block;" @else style="display: none;" @endif>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Pemohon</h4>
                    <button type="button" wire:click='showModalnya' class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal mt-2" wire:submit='save'>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row mb-2">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Nama
                                            <small class="text-danger">*</small>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" wire:model='form.name'
                                                placeholder="Nama">
                                            @error('form.name')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">NIK
                                            <small class="text-danger">*</small>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" wire:model='form.nik'
                                                placeholder="NIK">
                                            @error('form.nik')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Telepon
                                            <small class="text-danger">*</small>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" wire:model='form.wa'
                                                placeholder="Nomor WhatsApp">
                                            @error('form.wa')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="inputEmail3" class="col-sm-3 col-form-label">Email
                                            <small class="text-danger">*</small>
                                        </label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" wire:model='form.email'
                                                placeholder="Email">
                                            @error('form.email')
                                                <span class="form-text text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Simpan
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal"
                        wire:click='showModalnya'>Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</div>
