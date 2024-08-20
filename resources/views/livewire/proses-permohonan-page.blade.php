<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Proses Permohonan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Permohonan </li>
                    <li class="breadcrumb-item"><a href="#">Proses</a></li>
                </ol>
            </div>
        </div>
    </x-slot>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <livewire:components.user-profile-component userId="1">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Data Pengajuan</h3>
                            </div>

                            <div class="card-body">
                                <strong><i class="mr-1 fas fa-book"></i> No Pengajuan: {{ $isian->order_no }}</strong>
                                <p class="text-muted">

                                </p>
                                <hr>
                                <strong><i class="mr-1 fas fa-map-marker-alt"></i> Status:
                                    {{ $isian->statusPengajuan->code_nm ?? '-' }}</strong>
                                <p class="text-muted"></p>
                                <hr>

                            </div>

                        </div>

                </div>

                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Proses Penilaian</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="order-2 col-12 col-md-12 col-lg-12 order-md-1">
                                    <livewire:components.uttp-proses-component :id="$idnya">
                                </div>
                            </div>
                        </div>

                    </div>
                    <livewire:components.form-persetujuan-component :idnya="$idnya">
                        @if ($isian->pengajuan_st == 'PENGAJUAN_ST_02')
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Proses Penilaian</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                            title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="order-2 col-12 col-md-12 col-lg-12 order-md-1">
                                            <livewire:components.form-proses-component :id="$idnya">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        @endif
                </div>

            </div>

        </div>
    </section>
</div>
