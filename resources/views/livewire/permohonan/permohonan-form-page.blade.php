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
                                                                class="col-sm-2 col-form-label">Nomor Permohonan</label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    value="{{ genNo() }}" id="inputEmail3"
                                                                    disabled placeholder="Nomor">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputEmail3"
                                                                class="col-sm-2 col-form-label">Tanggal</label>
                                                            <div class="col-sm-10">
                                                                <input type="date"
                                                                    class="form-control @error('form.tanggal') is-invalid @enderror"
                                                                    wire:model='form.tanggal'>
                                                                @error('form.tanggal')
                                                                    <span
                                                                        class="form-text text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword3"
                                                                class="col-sm-2 col-form-label">Jenis Layanan</label>
                                                            <div class="col-sm-10">
                                                                <select name="" id=""
                                                                    wire:model.live='form.pengajuan_tp'
                                                                    class="form-control @error('form.pengajuan_tp') is-invalid @enderror">
                                                                    <option value="">Pilih Jenis Layanan
                                                                    </option>
                                                                    @foreach ($jenisPengajuan as $item)
                                                                        <option value="{{ $item->com_cd }}">
                                                                            {{ $item->code_nm }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('form.pengajuan_tp')
                                                                    <span
                                                                        class="form-text text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        @if ($bukaAlamat)
                                                            <div class="form-group row">
                                                                <label for="inputPassword3"
                                                                    class="col-sm-2 col-form-label">Alamat</label>
                                                                <div class="col-sm-10">
                                                                    <textarea name="" wire:model='form.alamat' class="form-control @error('form.alamat') is-invalid @enderror"
                                                                        id="" cols="30" rows="3"></textarea>
                                                                    @error('form.alamat')
                                                                        <span
                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="inputPassword3"
                                                                    class="col-sm-2 col-form-label">Upload Surat
                                                                    Permohonan</label>
                                                                <div class="col-sm-5">
                                                                    <input type="file" class="form-control"
                                                                        wire:model='files'>
                                                                    @error('files')
                                                                        <span
                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <a href="{{ asset('template/template_permohonan_pemohon.docx') }}"
                                                                        class="btn btn-info rounded-round btn-sm"
                                                                        target="_blank"><i
                                                                            class="fas fa-file-download mr-1"></i>
                                                                        Unduh
                                                                        Template Surat Permohonan</a>
                                                                </div>
                                                            </div>
                                                        @endif


                                                        <div class="card card-info">
                                                            <div class="card-header">
                                                                <h3 class="card-title">UTTP Yang Akan Ditera / Tera
                                                                    Ulang
                                                                </h3>
                                                            </div>
                                                            <div class="card-body">
                                                                @foreach ($uttpForm as $index => $item)
                                                                    <div class="mt-2 row">
                                                                        <div class=" row bg-light">
                                                                            <div class="col-md-6 row">
                                                                                <div class="mb-3 col-sm-6 col-xs-12">
                                                                                    <label>Jenis UTTP *</label>
                                                                                    <select name=""
                                                                                        class="form-control @error('formUttp.' . $index . '.uttp_id') is-invalid @enderror"
                                                                                        wire:model='formUttp.{{ $index }}.uttp_id'
                                                                                        id="uttp">
                                                                                        <option value="">Pilih
                                                                                            Jenis UTTP
                                                                                        </option>
                                                                                        @foreach ($uttp as $item)
                                                                                            <option
                                                                                                value="{{ $item->id }}">
                                                                                                {{ $item->nama }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="mb-3 col-sm-6 col-xs-12">
                                                                                    <label>Merek</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='formUttp.{{ $index }}.merek'
                                                                                        placeholder="merek">
                                                                                </div>
                                                                                <div class="mb-3 col-sm-6 col-xs-12">
                                                                                    <label>No Seri</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='formUttp.{{ $index }}.no_seri'
                                                                                        placeholder="No Seri">
                                                                                </div>
                                                                                <div class="mb-3 col-sm-6 col-xs-12">
                                                                                    <label>Jenis</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='formUttp.{{ $index }}.tipe'
                                                                                        placeholder="Jenis">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-5 row">
                                                                                <div class="mb-3 col-sm-6 col-xs-12">
                                                                                    <label>Kapasitas</label>
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='formUttp.{{ $index }}.kapasitas'
                                                                                        placeholder="Kapasitas">
                                                                                </div>
                                                                                <div class="mb-3 col-sm-6 col-xs-12">
                                                                                    <label>Jumlah</label>
                                                                                    <input type="number"
                                                                                        class="form-control @error('formUttp.' . $index . '.jumlah') is-invalid @enderror"
                                                                                        wire:model='formUttp.{{ $index }}.jumlah'
                                                                                        placeholder="Jumlah">
                                                                                </div>
                                                                                <div class="mb-3 col-sm-12 col-xs-12">
                                                                                    <label>Keterangan</label>
                                                                                    <input type="text"
                                                                                        class="form-control @error('formUttp.' . $index . '.jumlah') is-invalid @enderror"
                                                                                        wire:model='formUttp.{{ $index }}.keterangan'
                                                                                        placeholder="Keterangan">
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-1 ">
                                                                                <div class="mt-3">
                                                                                    <button type="button"
                                                                                        class="btn btn-sm btn-block btn-danger"
                                                                                        wire:click='hapusUttp({{ $index }})'>
                                                                                        <span
                                                                                            class="fas fa-trash"></span>Hapus</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="card-footer">
                                                                <button type="button" wire:click='tambahUttp'
                                                                    class="float-right btn btn-primary"> <span
                                                                        class="mr-2 fas fa-plus"></span>Ajukan
                                                                    UTTP</button>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="card-footer">

                                                        <button type="submit"
                                                            class=" btn btn-default">Cancel</button>
                                                        <button type="submit" class="float-right btn btn-info"> <span
                                                                class="mr-2 fas fa-paper-plane"></span>Kirim
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

    <!-- Modal -->
    <div class="modal fade @if ($showModal) show @endif" tabindex="-1" role="dialog"
        style="display: @if ($showModal) block @else none @endif;">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Daftar Uttp Saya</h5><br>
                    <button type="button" class="close" wire:click="tambahUttp" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" wire:submit='tambahPengajuan'>
                    <div class="modal-body table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table">
                            <thead>
                                <th>#</th>
                                <th>Uttp</th>
                                <th>Merek</th>
                                <th>No Seri</th>
                                <th>Tipe</th>
                                <th>Kapasitas</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </thead>
                            <tbody>
                                @foreach ($listUttp as $item)
                                    <tr :key="$item['id']">
                                        <td><input type="checkbox" wire:model='selectedUttp'
                                                value="{{ $item['id'] }}"></td>
                                        <td>{{ $item['uttp']['nama'] ?? '-' }}</td>
                                        <td>{{ $item['merek'] ?? '-' }}</td>
                                        <td>{{ $item['no_seri'] ?? '-' }}</td>
                                        <td>{{ $item['tipe'] ?? '-' }}</td>
                                        <td>{{ $item['kapasitas'] ?? '-' }}</td>
                                        <td>{{ $item['jumlah'] ?? '-' }}</td>
                                        <td>{{ $item['keterangan'] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer d-flex justify-content-between">
                        <a href="{{ route('user-uttp') }}" class="btn btn-warning">Tambahkan Uttp Saya</a>
                        <div>
                            <button type="button" class="btn btn-secondary" wire:click="tambahUttp">Close</button>
                            <button type="submit" class="btn btn-primary">Ajukan</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>

@push('js')
    <script>
        $('#uttp').select2({
            theme: 'bootstrap4'
            300
        });
    </script>
@endpush
