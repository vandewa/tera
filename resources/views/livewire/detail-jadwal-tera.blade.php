<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Jadwal Tera</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Detail </li>
                    <li class="breadcrumb-item"><a href="#">Jadwal Tera</a></li>
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
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="mb-2 row">
                                                            <label class="col-sm-2 col-form-label">Lokasi
                                                                <small class="text-danger">*</small></label>
                                                            <div class="col-sm-10">
                                                                <input type="text" class="form-control"
                                                                    wire:model='form.lokasi' placeholder="Lokasi"
                                                                    disabled>
                                                                @error('form.lokasi')
                                                                    <span
                                                                        class="form-text text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-sm-2 col-form-label">Tanggal
                                                                Mulai</label>
                                                            <div class="col-sm-10">
                                                                <input type="date" class="form-control"
                                                                    wire:model='form.tanggal_mulai' disabled>
                                                                @error('form.tanggal_mulai')
                                                                    <span
                                                                        class="form-text text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="mb-2 row">
                                                            <label class="col-sm-2 col-form-label">Tanggal
                                                                Selesai</label>
                                                            <div class="col-sm-10">
                                                                <input type="date" class="form-control"
                                                                    wire:model='form.tanggal_selesai' disabled>
                                                                @error('form.tanggal_selesai')
                                                                    <span
                                                                        class="form-text text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="inputEmail3"
                                                                class="col-sm-2 col-form-label">Status
                                                                Jadwal Tera</label>
                                                            <div class="col-sm-10">
                                                                <select class="form-control"
                                                                    wire:model='form.jadwal_tera_st' disabled>
                                                                    <option value="">Pilih
                                                                        Status</option>
                                                                    @foreach ($listJadwalTera ?? [] as $item)
                                                                        <option value="{{ $item['com_cd'] }}">
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


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="card-body">
                                                            <div class="card card-info">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Petugas
                                                                    </h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <form class="form-horizontal"
                                                                        wire:submit='savePetugas'>
                                                                        <div class="row mb-3">
                                                                            <div class="col-sm-12">
                                                                                <select class="form-control"
                                                                                    wire:model.live='formPetugas.user_id'
                                                                                    id="petugas">
                                                                                    <option value="">Pilih
                                                                                        Petugas</option>
                                                                                    @foreach ($petugas ?? [] as $item)
                                                                                        <option
                                                                                            value="{{ $item['id'] }}">
                                                                                            {{ $item['name'] }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('formPetugas.user_id')
                                                                                    <span
                                                                                        class="form-text text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                                {{-- <div class="card-footer"> --}}
                                                                                <button type="submit"
                                                                                    class="float-left btn btn-info mt-3">Tambah
                                                                                    Petugas</button>
                                                                                {{-- </div> --}}
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Nama Petugas</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($userPetugas as $item)
                                                                                        <tr>
                                                                                            <td>{{ $item->name ?? '' }}
                                                                                            </td>
                                                                                            <td>
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-danger"
                                                                                                    wire:click="hapusPetugas('{{ $item->id }}')">Hapus
                                                                                                </button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        {{-- {{ $posts->links() }} --}}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card-body">
                                                            <div class="card card-info">
                                                                <div class="card-header">
                                                                    <h3 class="card-title">Peralatan
                                                                    </h3>
                                                                </div>
                                                                <div class="card-body">
                                                                    <form class="form-horizontal"
                                                                        wire:submit='savePeralatan'>
                                                                        <div class="row mb-3">
                                                                            <div class="col-sm-12">
                                                                                <select class="form-control"
                                                                                    wire:model.live='formPeralatan.peralatan_id'>
                                                                                    <option value="">Pilih
                                                                                        Peralatan</option>
                                                                                    @foreach ($peralatan ?? [] as $item)
                                                                                        <option
                                                                                            value="{{ $item['id'] }}">
                                                                                            {{ $item['nama'] }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                                @error('formPeralatan.peralatan_id')
                                                                                    <span
                                                                                        class="form-text text-danger">{{ $message }}</span>
                                                                                @enderror
                                                                                <button type="submit"
                                                                                    class="float-left btn btn-info mt-3">Tambah
                                                                                    Peralatan</button>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                    <div class="card-body">
                                                                        <div class="table-responsive">
                                                                            <table class="table">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>Nama Peralatan</th>
                                                                                        <th></th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @foreach ($userPeralatan as $item)
                                                                                        <tr>
                                                                                            <td>{{ $item->peralatan->nama ?? '' }}
                                                                                            </td>
                                                                                            <td>
                                                                                                <button type="button"
                                                                                                    class="btn btn-sm btn-danger"
                                                                                                    wire:click="hapusPetugas('{{ $item->id }}')">Hapus
                                                                                                </button>
                                                                                            </td>
                                                                                        </tr>
                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                        {{-- {{ $posts->links() }} --}}
                                                                    </div>
                                                                </div>
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

@push('js')
    <script>
        document.addEventListener('livewire:load', function() {
            // Initialize Select2
            $('#select2-example').select2();

            // Listen for changes on Select2 and update Livewire
            $('#select2-example').on('change', function(e) {
                @this.set('selectedOption', $(this).val());
            });
        });
    </script>
@endpush
