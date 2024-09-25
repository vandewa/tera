<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Permohonan Tera
                    @if ($idnya == 1)
                        di Kantor
                    @else
                        di Lokasi Alat
                    @endif

                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Permohonan </li>
                    <li class="breadcrumb-item">
                        <a href="#">Tera
                            @if ($idnya == 1)
                                di Kantor
                            @else
                                di Lokasi Alat
                            @endif
                        </a>
                    </li>
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

                                                    @if ($idnya == 1)
                                                        di Kantor
                                                    @else
                                                        di Lokasi Alat
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3 row justify-content-between">
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control" placeholder="cari"
                                                            wire:model.live='cari'>
                                                    </div>
                                                </div>

                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <th>Nomor</th>
                                                            <th>Tanggal</th>
                                                            <th>Nama</th>
                                                            <th>Jenis Pelayanan</th>
                                                            <th>Status</th>
                                                            <th>UTTP</th>
                                                            <th>Aksi</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($post as $datum)
                                                                <tr>
                                                                    <td>
                                                                        {{ $datum->order_no }}
                                                                    </td>
                                                                    <td>
                                                                        {{ Carbon\Carbon::parse($datum->jadwal->tanggal_mulai ?? '')->isoFormat(' D MMMM Y') }}
                                                                        @if ($datum->jadwal->lokasi ?? null)
                                                                            ( {{ $datum->jadwal->lokasi ?? '' }})
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        {{ $datum->user->name ?? '' }}
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
                                                                                        href="{{ route('permohonan-proses', $datum->id) }}"><i
                                                                                            class="mr-2 far fa-arrow-alt-circle-right"></i>Proses</a>
                                                                                <li><a class="dropdown-item"
                                                                                        href="{{ route('helper.cetak-order', ['id' => $datum->id, 'jenis_download' => 'formulir_permohonan']) }}"><i
                                                                                            class="mr-2 fas fa-download"></i>Download
                                                                                        Formulir</a>

                                                                                </li>
                                                                                <li><a class="dropdown-item"
                                                                                        href="{{ route('helper.cetak-order', ['id' => $datum->id, 'jenis_download' => 'tanda_terima']) }}"><i
                                                                                            class="mr-2 fas fa-file-download"></i>Download
                                                                                        Kartu
                                                                                        Order</a>

                                                                                </li>
                                                                                <li><a class="dropdown-item"
                                                                                        href="{{ route('admin.permohonan.create', $datum->id) }}"><i
                                                                                            class="mr-2 far fa-edit"></i>Edit</a>
                                                                                </li>
                                                                                <li><button class="dropdown-item"
                                                                                        wire:click="delete('{{ $datum->id }}')"><i
                                                                                            class="mr-2 far fa-trash-alt"></i>Hapus</button>
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
