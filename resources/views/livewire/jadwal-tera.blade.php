<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Jadwal Sidang Tera</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Master</li>
                    <li class="breadcrumb-item"><a href="#">Jadwal Sidang Tera</a></li>
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
                                        <div class="card card-info card-outline card-tabs">
                                            <div class="tab-content" id="custom-tabs-six-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-six-riwayat-rm"
                                                    role="tabpanel" aria-labelledby="custom-tabs-six-riwayat-rm-tab">
                                                    <div class="card-body">
                                                        @role(['superadministrator', 'administrator'])
                                                            <div class="col-md-12">
                                                                <form class="mt-2 form-horizontal" wire:submit='save'>
                                                                    <div class="card-body">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="mb-2 row">
                                                                                    <label
                                                                                        class="col-sm-2 col-form-label">Lokasi
                                                                                        <small
                                                                                            class="text-danger">*</small></label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="text"
                                                                                            class="form-control"
                                                                                            wire:model='form.lokasi'
                                                                                            placeholder="Lokasi">
                                                                                        @error('form.lokasi')
                                                                                            <span
                                                                                                class="form-text text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-2 row">
                                                                                    <label
                                                                                        class="col-sm-2 col-form-label">Tanggal
                                                                                        Mulai</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="date"
                                                                                            class="form-control"
                                                                                            wire:model='form.tanggal_mulai'>
                                                                                        @error('form.tanggal_mulai')
                                                                                            <span
                                                                                                class="form-text text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-2 row">
                                                                                    <label
                                                                                        class="col-sm-2 col-form-label">Tanggal
                                                                                        Selesai</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="date"
                                                                                            class="form-control"
                                                                                            wire:model='form.tanggal_selesai'>
                                                                                        @error('form.tanggal_selesai')
                                                                                            <span
                                                                                                class="form-text text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-2 row">
                                                                                    <label
                                                                                        class="col-sm-2 col-form-label">Upload
                                                                                        Surat Tugas</label>
                                                                                    <div class="col-sm-10">
                                                                                        <input type="file"
                                                                                            class="form-control"
                                                                                            wire:model='uploadSuratTugas'>
                                                                                        @error('uploadSuratTugas')
                                                                                            <span
                                                                                                class="form-text text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                                <div class="mb-3 row">
                                                                                    <label for="inputEmail3"
                                                                                        class="col-sm-2 col-form-label">Status
                                                                                        Jadwal Tera</label>
                                                                                    <div class="col-sm-10">
                                                                                        <select class="form-control"
                                                                                            wire:model='form.jadwal_tera_st'>
                                                                                            <option value="">Pilih
                                                                                                Status</option>
                                                                                            @foreach ($listJadwalTera ?? [] as $item)
                                                                                                <option
                                                                                                    value="{{ $item['com_cd'] }}">
                                                                                                    {{ $item['code_nm'] }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        @error('form.jadwal_tera_st')
                                                                                            <span
                                                                                                class="form-text text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="mt-3 card-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-info">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <br>
                                                        @endrole
                                                        <div class="card card-info card-outline">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    Jadwal Sidang Tera
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="cari" wire:model.live='cari'>
                                                                    </div>
                                                                </div>

                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <th>No</th>
                                                                            <th>Lokasi</th>
                                                                            <th>Tanggal Mulai</th>
                                                                            <th>Tanggal Selesai</th>
                                                                            <th>Surat Tugas</th>
                                                                            <th>Status</th>
                                                                            <th>Aksi</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($post as $item)
                                                                                <tr wire:key='{{ $item->id }}'>
                                                                                    <td>{{ $loop->index + $post->firstItem() }}
                                                                                    </td>
                                                                                    <td> {{ $item->lokasi ?? '-' }}</td>
                                                                                    <td> {{ $item->tanggal_mulai ?? '-' }}
                                                                                    </td>
                                                                                    <td> {{ $item->tanggal_selesai ?? '-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="list-icons">
                                                                                            <a href="{{ route('helper.show-picture', ['path' => $item->surat_tugas_path]) }}"
                                                                                                class="btn btn-info rounded-round btn-sm"
                                                                                                target="_blank">
                                                                                                <i
                                                                                                    class="mr-2 fas fa-file-word">
                                                                                                </i>
                                                                                                Lihat File
                                                                                            </a>
                                                                                        </div>
                                                                                    </td>

                                                                                    <td> {{ $item->status->code_nm ?? '-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        <div
                                                                                            class="gap-3 table-actions d-flex align-items-center fs-6">
                                                                                            <div class="mr-2">
                                                                                                @role(['superadministrator',
                                                                                                    'administrator'])
                                                                                                    <button type="button"
                                                                                                        wire:click="getEdit('{{ $item->id }}')"
                                                                                                        class="btn btn-warning btn-flat btn-sm"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="left"
                                                                                                        title="Edit"><i
                                                                                                            class="mr-1 fas fa-edit"></i>
                                                                                                        Edit
                                                                                                    </button>


                                                                                                    <a href="{{ route('detail-jadwal-tera', $item->id) }}"
                                                                                                        class="btn btn-success btn-flat btn-sm"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="left"
                                                                                                        title="Pilih Penera"><i
                                                                                                            class="mr-1 fas fa-user-plus"></i>Penera
                                                                                                    </a>
                                                                                                @endrole
                                                                                                @role(['penera',
                                                                                                    'superadministrator',
                                                                                                    'administrator'])
                                                                                                    <a href="{{ route('jadwal-tera-peserta', $item->id) }}"
                                                                                                        class="btn btn-info btn-flat btn-sm"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="left"
                                                                                                        title="Pilih Penera"><i
                                                                                                            class="mr-1 fas fa-user-plus"></i>Peserta
                                                                                                    </a>
                                                                                                    <a href="{{ route('laporan.rekap-sidang', ['id' => $item->id]) }}"
                                                                                                        target="_blank"
                                                                                                        class="btn btn-info btn-flat btn-sm"
                                                                                                        data-toggle="tooltip"
                                                                                                        data-placement="left"
                                                                                                        title="Pilih Penera"><i
                                                                                                            class="mr-1 fas fa-user-plus"></i>Rekap
                                                                                                    </a>
                                                                                                @endrole
                                                                                                @role(['superadministrator',
                                                                                                    'administrator'])
                                                                                                    <button type="button"
                                                                                                        class="btn btn-danger btn-flat btn-sm"
                                                                                                        wire:click="delete('{{ $item->id }}')"><i
                                                                                                            class="mr-1 fas fa-trash-alt"></i>Hapus
                                                                                                    </button>
                                                                                                @endrole
                                                                                            </div>
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                {{ $post->links() }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
</div>
