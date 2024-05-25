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
                                                <div class="mb-3 row justify-content-between">
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" placeholder="cari"
                                                            wire:model.live='cari'>
                                                    </div>
                                                    <div class="col-md-2 pull-right">
                                                        <a href="{{ route('permohonan.create') }}"
                                                            class="btn btn-primary">Tambah Permohonan</a>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Aksi</th>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                    </table>
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

    {{-- Modal data --}}

    {{-- end modal  --}}
</div>
