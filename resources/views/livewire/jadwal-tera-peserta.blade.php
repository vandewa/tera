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
                    <div class="card">
                        <div class="card-body">

                            <hr>
                            <form action="">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" class="form-control" placeholder="Nama">
                                        </div>
                                        <div class="form-group">
                                            <label>Telepon</label>
                                            <input type="text" class="form-control" placeholder="Telepon">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Jenis UTTP</label>
                                                    <select class="form-control" placeholder="Nama">
                                                        <option value="">Pilih Uttp</option>
                                                        @foreach ($listUttp as $item)
                                                            <option value="{{ $item->id }}">{{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label>Jumlan</label>
                                                    <input type="number" class="form-control" placeholder="jumlah">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label></label>
                                                    <button class="btn btn-primary form-control"><span
                                                            class="fas fa-plus"></span></button>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label></label>
                                                    <button class="btn btn-warning form-control"><span
                                                            class="fas fa-plus"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <table class="table">
                                                <thead>
                                                    <th>Jenis Uttp</th>
                                                    <th>Jumlah</th>
                                                    <th></th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
