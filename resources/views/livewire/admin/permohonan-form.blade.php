<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Permohonan Tera</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Permohonan </li>
                    <li class="breadcrumb-item"><a href="#">Tera</a></li>
                </ol>
            </div>
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <div class="tab-pane fade active show">
                            <div class="tab-pane active show fade" id="custom-tabs-one-rm" role="tabpanel"
                                aria-labelledby="custom-tabs-one-rm-tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card card-info card-outline">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    Permohonan Tera
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form class="form-horizontal" wire:submit='save'>
                                                    <div class="card-body">
                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-2 col-form-label">Nomor Pengajuan</label>
                                                            <div class="col-sm-10">
                                                                <input type="email" class="form-control"
                                                                    value="{{ genNo() }}" id="inputEmail3"
                                                                    disabled placeholder="Nomor">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword3"
                                                                class="col-sm-2 col-form-label">Jadwal</label>
                                                            <div class="col-sm-10">
                                                                <select name="" id=""
                                                                    wire:model.live='form.jadwal_tera_id'
                                                                    class="form-control @error('form.jadwal_tera_id') is-invalid @enderror">
                                                                    <option value="">Pilih Jadwal
                                                                    </option>
                                                                    @foreach ($jadwal as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->lokasi . ' (' . Carbon\Carbon::parse($item->tanggal_mulai)->isoFormat(' D MMMM Y') . ')' }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label for=""
                                                                class="col-sm-2 col-form-label">Pemohon</label>
                                                            <div class="col-md-5">
                                                                <div class="input-group ">
                                                                    <p class="form-control">{{ $user->name ?? '-' }}</p>
                                                                    <span class="input-group-append">
                                                                        <button type="button"
                                                                            class="btn btn-info btn-flat"
                                                                            wire:click="$dispatch('show-modal-user')">Pilih</button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <button type="button" class="btn btn-danger btn-flat"
                                                                    wire:click="$dispatchTo('component.modal-tambah-user','show-modal-tambah-user')">
                                                                    *Klik
                                                                    disini apabila data pemohon belum ada</button>
                                                            </div>

                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword3"
                                                                class="col-sm-2 col-form-label">Jenis Pengajuan</label>
                                                            <div class="col-sm-10">
                                                                <select name="" id=""
                                                                    wire:model.live='form.pengajuan_tp'
                                                                    class="form-control @error('form.pengajuan_tp') is-invalid @enderror">
                                                                    <option value="">Pilih Jenis Pengajuan
                                                                    </option>
                                                                    @foreach ($jenisPengajuan as $item)
                                                                        <option value="{{ $item->com_cd }}">
                                                                            {{ $item->code_nm }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @if ($bukaAlamat)
                                                            <div class="form-group row">
                                                                <label for="inputPassword3"
                                                                    class="col-sm-2 col-form-label">Alamat</label>
                                                                <div class="col-sm-10">
                                                                    <textarea name="" wire:model='form.alamat' class="form-control @error('form.alamat') is-invalid @enderror"
                                                                        id="" cols="30" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="card card-info">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Jenis UTTP Yang Ingin di Tera
                                                                </h3>
                                                            </div>
                                                            <div class="card-body">
                                                                @foreach ($uttpForm as $index => $item)
                                                                    <div class="mt-2 row">
                                                                        <div class="col-lg-2 col-sm-6 col-xs-12">
                                                                            <label>Jenis UTTP *</label>
                                                                            <select name=""
                                                                                class="form-control @error('formUttp.' . $index . '.uttp_id') is-invalid @enderror"
                                                                                wire:model='formUttp.{{ $index }}.uttp_id'
                                                                                id="uttp">
                                                                                <option value="">Pilih Jenis UTTP
                                                                                </option>
                                                                                @foreach ($uttp as $item)
                                                                                    <option value="{{ $item->id }}">
                                                                                        {{ $item->nama }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-lg-2 col-sm-6 col-xs-12">
                                                                            <label>Merek</label>
                                                                            <input type="text" class="form-control"
                                                                                wire:model='formUttp.{{ $index }}.merek'
                                                                                placeholder="merek">
                                                                        </div>
                                                                        <div class="col-lg-2 col-sm-6 col-xs-12">
                                                                            <label>No Seri</label>
                                                                            <input type="text" class="form-control"
                                                                                wire:model='formUttp.{{ $index }}.no_seri'
                                                                                placeholder="No Seri">
                                                                        </div>

                                                                        <div class="col-lg-2 col-sm-6 col-xs-12">
                                                                            <label>Jenis</label>
                                                                            <input type="text" class="form-control"
                                                                                wire:model='formUttp.{{ $index }}.tipe'
                                                                                placeholder="Jenis">
                                                                        </div>
                                                                        <div class="col-lg-2 col-sm-6 col-xs-12">
                                                                            <label>Kapasitas</label>
                                                                            <input type="text" class="form-control"
                                                                                wire:model='formUttp.{{ $index }}.kapasitas'
                                                                                placeholder="Kapasitas">
                                                                        </div>
                                                                        <div class="col-lg-1 col-sm-6 col-xs-12">
                                                                            <label>Jumlah*</label>
                                                                            <input type="number"
                                                                                class="form-control @error('formUttp.' . $index . '.jumlah') is-invalid @enderror"
                                                                                wire:model='formUttp.{{ $index }}.jumlah'
                                                                                placeholder="Jumlah">
                                                                        </div>
                                                                        <div class="mt-4 col-lg-1 col-sm-6 col-xs-12">
                                                                            <button type="button"
                                                                                class="btn btn-sm btn-block btn-danger"
                                                                                wire:click='hapusUttp({{ $index }})'>
                                                                                <span
                                                                                    class="fas fa-trash"></span></button>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="card-footer">
                                                                <button type="button" wire:click='tambahUttp'
                                                                    class="float-right btn btn-primary">Tambah</button>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="card-footer">
                                                        <button type="submit"
                                                            class=" btn btn-default">Cancel</button>
                                                        <button type="submit" class="float-right btn btn-info">Kirim
                                                            Pengajuan</button>
                                                    </div>

                                                </form>


                                            </div>
                                        </div>
                                        <!-- /.card -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <livewire:component.modal-user wire:key='modal-user'>
        <livewire:component.modal-tambah-user wire:key='modal-tambah-user'>
</div>

@push('js')
    <script>
        $('#uttp').select2({
            theme: 'bootstrap4'
            300
        });
    </script>
@endpush
