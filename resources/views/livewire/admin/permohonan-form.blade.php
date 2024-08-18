<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Pengajuan Tera</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Pengajuan </li>
                    <li class="breadcrumb-item"><a href="#">Jenis UTTP</a></li>
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
                                                                class="col-sm-2 col-form-label">Jadwal Tera</label>
                                                            <div class="col-sm-10">
                                                                <select name="" id=""
                                                                    wire:model.live='form.jadwal_tera_id'
                                                                    class="form-control @error('form.jadwal_tera_id') is-invalid @enderror">
                                                                    <option value="">Pilih Jadwal
                                                                    </option>
                                                                    @foreach ($jadwal as $item)
                                                                        <option value="{{ $item->id }}">
                                                                            {{ $item->lokasi }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
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

    {{-- Modal data --}}

    {{-- end modal  --}}
</div>

@push('js')
    <script>
        $('#uttp').select2({
            theme: 'bootstrap4'
            300
        });
    </script>
@endpush
