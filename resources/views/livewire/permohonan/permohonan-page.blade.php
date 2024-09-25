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
                                                <div class="mb-3 row justify-content-between">
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" placeholder="cari"
                                                            wire:model.live='cari'>
                                                    </div>
                                                    <div class="col-md-2 pull-right">
                                                        <a href="{{ route('permohonan.create') }}"
                                                            class="btn btn-primary">
                                                            <span class="fas fa-plus mr-2">
                                                            </span>Tambah Permohonan</a>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <th>Tanggal</th>
                                                            <th>Nomor Order</th>
                                                            <th>Jenis Layanan</th>
                                                            <th>Status</th>
                                                            <th>UTTP</th>
                                                            <th>Aksi</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($post as $datum)
                                                                <tr>

                                                                    <td> {{ \Carbon\Carbon::createFromTimeStamp(strtotime($datum->created_at))->isoFormat('D MMMM Y') }}
                                                                    </td>
                                                                    <td>
                                                                        {{ $datum->order_no }}
                                                                    </td>
                                                                    <td>{{ $datum->jenisPengajuan->code_nm ?? '-' }}
                                                                        @if ($datum->alamat)
                                                                            {{ '( ' . $datum->alamat . ' )' }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($datum->statusPengajuan->com_cd == 'PENGAJUAN_ST_01')
                                                                            <span
                                                                                class="badge badge-dark">{{ $datum->statusPengajuan->code_nm }}</span>
                                                                        @elseif($datum->statusPengajuan->com_cd == 'PENGAJUAN_ST_02')
                                                                            <span
                                                                                class="badge badge-warning">{{ $datum->statusPengajuan->code_nm }}</span>
                                                                        @elseif($datum->statusPengajuan->com_cd == 'PENGAJUAN_ST_03')
                                                                            <span
                                                                                class="badge badge-danger">{{ $datum->statusPengajuan->code_nm }}</span>
                                                                        @elseif($datum->statusPengajuan->com_cd == 'PENGAJUAN_ST_04')
                                                                            <span
                                                                                class="badge badge-info">{{ $datum->statusPengajuan->code_nm }}</span>
                                                                        @elseif($datum->statusPengajuan->com_cd == 'PENGAJUAN_ST_05')
                                                                            <span
                                                                                class="badge badge-success">{{ $datum->statusPengajuan->code_nm }}</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <ul>
                                                                            @foreach ($datum->uttpItem as $item)
                                                                                <li> {{ $item->uttp->nama ?? '-' }}
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <button type="button"
                                                                                class="btn btn-default "
                                                                                data-toggle="dropdown"
                                                                                aria-expanded="false">
                                                                                <i class="fas fa-bars"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu" style="">
                                                                                <li><a class="dropdown-item"
                                                                                        href="{{ route('permohonan.create', $datum->id) }}"><i
                                                                                            class="far fa-edit mr-2"></i>Edit</a>
                                                                                </li>
                                                                                <li><button class="dropdown-item"
                                                                                        wire:click="delete('{{ $datum->id }}')"><i
                                                                                            class="far fa-trash-alt mr-2"></i>Hapus</button>
                                                                                </li>
                                                                            </ul>
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
