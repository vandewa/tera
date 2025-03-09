<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Peserta Sidang Tera</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Jadwal Tera </li>
                    <li class="breadcrumb-item"><a href="#">Peserta</a></li>
                </ol>
            </div>
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <livewire:components.info-jadwal-tera :id="$idnya" />
                    <div class="card">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">
                            <h3 class="card-title">
                                <i class="ion ion-clipboard mr-1"></i>
                                Tambah Peserta Tera
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="" id="myForm" wire:submit='simpan'>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" wire:model='form.nama'
                                                placeholder="Nama">
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="text" class="form-control" wire:model='form.telepon'
                                                placeholder="Telepon">
                                        </div>
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-primary">Simpan</button>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Jenis UTTP</label>
                                                    <select class="form-control" placeholder="Nama"
                                                        wire:model='uttp.uttp_id'>
                                                        <option value="">Pilih Uttp</option>
                                                        @foreach ($listUttp as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('uttp.uttp_id')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Jumlan</label>
                                                    <input type="number" wire:model='uttp.jumlah' class="form-control"
                                                        placeholder="jumlah">
                                                    @error('uttp.jumlah')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label></label>
                                                    <button type="button" class="btn btn-primary form-control"
                                                        wire:click='tambahUttp'><span
                                                            class="fas fa-plus"></span></button>
                                                </div>
                                            </div>
                                            <div class="col-md-1">

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="table-responsive">
                                                <table class="table table-sm">
                                                    <thead>
                                                        <th>Jenis Uttp</th>
                                                        <th>Jumlah</th>
                                                        <th></th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($this->dataUttpPeserta as $index => $item)
                                                            <tr>
                                                                <td>{{ $this->namaUttp($item['uttp_id'])->nama ?? '-' }}
                                                                </td>
                                                                <td>{{ $item['jumlah'] }}</td>
                                                                <td><button type="button"
                                                                        wire:click='hapusTemporartyUttp({{ $index }})'
                                                                        class="btn btn-danger"><span
                                                                            class="fas fa-trash"></span></button></td>
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>
                            <div class="row mt-3">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <th>Nama</th>
                                            <th>Telepon</th>
                                            <th>Uttp</th>
                                            <th>#</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $item->nama }}</td>
                                                    <td>{{ $item->telepon }}</td>
                                                    <td>
                                                        <ul>
                                                            @foreach ($item->uttpPesertaSidang ?? [] as $datum)
                                                                <li>{{ $datum->uttp->nama ?? '' }} -
                                                                    <strong>( {{ $datum->jumlah }}) </strong>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-danger btn-flat btn-sm"
                                                            wire:click="delete('{{ $item->id }}')"><i
                                                                class="fas fa-trash"></i>
                                                        </button>
                                                        <button class="btn btn-warning btn-sm"
                                                            wire:click='edit({{ $item->id }})'>Edit</button>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    {{ $data->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
