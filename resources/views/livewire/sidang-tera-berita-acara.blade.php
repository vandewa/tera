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
                                <i class="mr-1 ion ion-clipboard"></i>
                                Rekap Hasil Sidang Tera
                            </h3>
                        </div>
                        <div class="card-body">
                            <form action="" id="myForm" wire:submit='simpan'>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Sah</label>
                                            <input type="number" wire:model='form.sah' class="form-control"
                                                wire:model='form.nama' placeholder="Nama">
                                        </div>
                                        <div class="form-group">
                                            <label>Tidak Sah</label>
                                            <input type="number" wire:model='form.tidak_sah' class="form-control"
                                                wire:model='form.telepon' placeholder="Telepon">
                                        </div>
                                        <div>
                                            @if (session('status'))
                                                <div class="alert alert-success">
                                                    {{ session('status') }}
                                                </div>
                                            @endif

                                        </div>
                                        <div class="text-right col-md-12">
                                            <a href="#" class="btn btn-info" data-toggle="tooltip"
                                                data-placement="top" title="Downbload Berita Acara"><span
                                                    class="fas fa-download"></span></a>
                                            <button class="btn btn-primary"><span class="fas fa-pencil"
                                                    data-toggle="tooltip" data-placement="top"
                                                    title="Update data sah dan tidak sah"></span></button>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <th>Nama</th>
                                                    <th>Jumlah</th>
                                                </thead>
                                                <tbody>
                                                    @foreach ($results as $result)
                                                        <tr>
                                                            <td>{{ $result->nama }}</td>
                                                            <td>{{ $result->jumlah }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </form>
                            <div class="mt-3 row">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
