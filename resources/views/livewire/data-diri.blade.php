<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Data Diri</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Data Diri</li>
                    {{-- <li class="breadcrumb-item"><a href="#">Jenis UTTP</a></li> --}}
                </ol>
            </div>
        </div>
    </x-slot>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-info card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('soul.png') }}"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $form['name'] ?? '-' }}</h3>

                            <p class="text-muted text-center">{{ $form['nik'] ?? '-' }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Nama Usaha</b> <br>
                                    <span>{{ $form['nama_usaha'] ?? '-' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Nomor WhatsApp</b> <br>
                                    <span>{{ $form['wa'] ?? '-' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <br>
                                    <span>{{ $form['email'] ?? '-' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Alamat</b> <br>
                                    <span>{{ $form['alamat'] ?? '-' }}</span>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <legend>Data Diri</legend>
                                    <form class="form-horizontal" wire:submit='save'>
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nama</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" wire:model.blur='form.name'
                                                    placeholder="Nama Pemilik">
                                                @error('form.name')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">NIK</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" wire:model.blur='form.nik'
                                                    placeholder="NIK">
                                                @error('form.nik')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-2 col-form-label">Nama Usaha</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control"
                                                    wire:model.blur='form.nama_usaha' placeholder="Nama Usaha">
                                                @error('form.nama_usaha')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" wire:model.blur='form.email'
                                                    placeholder="Email">
                                                @error('form.email')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputExperience" class="col-sm-2 col-form-label">Alamat</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="inputExperience" placeholder="Alamat" wire:model.blur='form.alamat'></textarea>
                                                @error('form.alamat')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-info">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
