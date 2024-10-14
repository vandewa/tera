<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Hasil Permohonan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Pengajuan</a></li>
                    <li class="breadcrumb-item active">Tera</li>
                </ol>
            </div>
        </div>
    </x-slot>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                Unduh SKHP
                            </div>
                        </div>
                        <div class="card-body">

                            <table class="table ">
                                <thead>
                                    <th>Nomor</th>
                                    <th>Nama</th>
                                    <th>Unduh Dokumen</th>
                                </thead>
                                <tbody>
                                    @foreach ($data as $index => $datum)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $datum->uttp->nama ?? '-' }}</td>
                                            <td></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>
