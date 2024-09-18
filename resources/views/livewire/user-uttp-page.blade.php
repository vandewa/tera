<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Uttp Saya</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Permohonan</li>
                    <li class="breadcrumb-item"><a href="#">Uttp</a></li>
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
                                                        <div class="col-md-12">
                                                            <form class="mt-2 form-horizontal" wire:submit='save'>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="mb-2 row">
                                                                                <label
                                                                                    class="col-sm-2 col-form-label">Nama
                                                                                    Uttp
                                                                                    <small
                                                                                        class="text-danger">*</small></label>
                                                                                <div class="col-sm-10">
                                                                                    <select name=""
                                                                                        wire:model='form.uttp_id'
                                                                                        class="form-control"
                                                                                        id="">
                                                                                        <option value="">Pilih
                                                                                            Jenis Uttp</option>
                                                                                        @foreach ($listUttp as $item)
                                                                                            <option
                                                                                                value="{{ $item['id'] }}">
                                                                                                {{ $item['nama'] }}
                                                                                            </option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                    @error('form.uttp_id')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-2 row">
                                                                                <label
                                                                                    class="col-sm-2 col-form-label">Nomor
                                                                                    Seri
                                                                                </label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='form.no_seri'
                                                                                        placeholder="Nomot Seri">
                                                                                    @error('form.no_seri')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-2 row">
                                                                                <label
                                                                                    class="col-sm-2 col-form-label">Merek
                                                                                </label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='form.merek'
                                                                                        placeholder="Merek">
                                                                                    @error('form.merek')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-2 row">
                                                                                <label
                                                                                    class="col-sm-2 col-form-label">Tipe
                                                                                </label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='form.tipe'
                                                                                        placeholder="Nomot Seri">
                                                                                    @error('form.tipe')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-2 row">
                                                                                <label
                                                                                    class="col-sm-2 col-form-label">Kapasitas
                                                                                </label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='form.kapasitas'
                                                                                        placeholder="Kapasitas">
                                                                                    @error('form.kapasitas')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-2 row">
                                                                                <label
                                                                                    class="col-sm-2 col-form-label">Jumlah
                                                                                </label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        wire:model='form.jumlah'
                                                                                        placeholder="Jumlah">
                                                                                    @error('form.jumlah')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="mb-2 row">
                                                                                <label
                                                                                    class="col-sm-2 col-form-label">Keterangan
                                                                                </label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='form.keterangan'
                                                                                        placeholder="keterangan">
                                                                                    <small id="emailHelp"
                                                                                        class="form-text text-muted">Isikan
                                                                                        jumlah keterangan lanjutan,
                                                                                        misalkan seperti jumlah
                                                                                        Noozle, pada pompa ukur Bahan
                                                                                        Bakar Minyak</small>
                                                                                    @error('form.keterangan')
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
                                                            </form>
                                                        </div>
                                                        <br>

                                                        <div class="card card-info card-outline">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    Peralatan
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
                                                                            <th>Uttp</th>
                                                                            <th>Merek</th>
                                                                            <th>No Seri</th>
                                                                            <th>Tipe</th>
                                                                            <th>Kapasitas</th>
                                                                            <th>Keterangan</th>
                                                                            <th>Aksi</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($post as $item)
                                                                                <tr wire:key='{{ $item->id }}'>
                                                                                    <td>{{ $loop->index + $post->firstItem() }}
                                                                                    </td>
                                                                                    <td> {{ $item->uttp->nama ?? '-' }}
                                                                                    </td>
                                                                                    <td> {{ $item->merek ?? '-' }}
                                                                                    </td>
                                                                                    <td> {{ $item->no_seri ?? '-' }}
                                                                                    </td>
                                                                                    <td> {{ $item->tipe ?? '-' }}
                                                                                    </td>
                                                                                    <td> {{ $item->kapasitas ?? '-' }}
                                                                                    <td> {{ $item->keterangan ?? '-' }}
                                                                                    </td>
                                                                                    <td>
                                                                                        <div
                                                                                            class="gap-3 table-actions d-flex align-items-center fs-6">
                                                                                            <div class="mr-2">
                                                                                                <button type="button"
                                                                                                    wire:click="getEdit('{{ $item->id }}')"
                                                                                                    class="btn btn-warning btn-flat btn-sm"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="left"
                                                                                                    title="Edit"><i
                                                                                                        class="fas fa-pencil-alt"></i>
                                                                                                </button>
                                                                                                <button type="button"
                                                                                                    class="btn btn-danger btn-flat btn-sm"
                                                                                                    wire:click="delete('{{ $item->id }}')"><i
                                                                                                        class="fas fa-trash"></i>
                                                                                                </button>
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
