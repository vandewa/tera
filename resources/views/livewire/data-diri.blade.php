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
                                    <b>Nama Perusahaan</b> <br>
                                    <span>{{ $form['nama_usaha'] ?? '-' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>WhatsApp</b> <br>
                                    <span>{{ $form['wa'] ?? '-' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Email</b> <br>
                                    <span>{{ $form['email'] ?? '-' }}</span>
                                </li>
                                <li class="list-group-item">
                                    <b>Alamat</b> <br>
                                    <span>{{ $form['alamat_perusahaan'] ?? '-' }}</span>
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
                                        <div class="row mb-2">
                                            <label for="inputName" class="col-sm-3 col-form-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" wire:model.blur='form.name'
                                                    placeholder="Nama Pemilik">
                                                @error('form.name')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="inputName" class="col-sm-3 col-form-label">NIK</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" wire:model.blur='form.nik'
                                                    placeholder="NIK">
                                                @error('form.nik')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="inputName" class="col-sm-3 col-form-label">Pekerjaan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    wire:model.blur='form.pekerjaan' placeholder="Pekerjaan">
                                                @error('form.pekerjaan')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="inputExperience" class="col-sm-3 col-form-label">Alamat</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" wire:model.blur='form.alamat'
                                                    placeholder="Alamat">
                                                @error('form.alamat')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" wire:model.blur='form.email'
                                                    placeholder="Email">
                                                @error('form.email')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <label for="inputName" class="col-sm-3 col-form-label">
                                                WhatsApp</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" wire:model.blur='form.wa'
                                                    placeholder="Nomor WhatsApp">
                                                @error('form.wa')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <label for="inputName" class="col-sm-3 col-form-label">Nama
                                                Perusahaan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    wire:model.blur='form.nama_usaha' placeholder="Nama Usaha">
                                                @error('form.nama_usaha')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="row mb-2">
                                            <label for="inputExperience" class="col-sm-3 col-form-label">Alamat
                                                Perusahaan</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control"
                                                    wire:model.blur='form.alamat_perusahaan'
                                                    placeholder="Alamat Perusahaan">
                                                @error('form.alamat_perusahaan')
                                                    <span class="form-text text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-check mb-3 mt-3">
                                            <input type="checkbox" class="form-check-input" id="exampleCheck1"
                                                wire:model.live='check'>
                                            <label class="form-check-label" for="exampleCheck1"><b>Ganti
                                                    Password</b></label>
                                        </div>

                                        @if ($check)
                                            <div class="mt-3">
                                                <center>
                                                    <h5>Ganti Password</h5>
                                                </center>
                                            </div>

                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row mb-2">
                                                        <label for="inputName"
                                                            class="col-sm-4 col-form-label">Password</label>
                                                        <div class="col-sm-8">
                                                            <input type="password" class="form-control"
                                                                wire:model='password'>
                                                            @error('password')
                                                                <span
                                                                    class="form-text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row mb-2">
                                                        <label for="inputName"
                                                            class="col-sm-4 col-form-label">Konfirmasi
                                                            Password</label>
                                                        <div class="col-sm-8">
                                                            <input type="password" class="form-control"
                                                                wire:model='password_confirmation'>
                                                            @error('password_confirmation')
                                                                <span
                                                                    class="form-text text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row mb-2">
                                            <div class="ml-auto">
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
