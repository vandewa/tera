<div>
    <x-slot name="header">
        <div class="mb-2 row">
            <div class="col-sm-6">
                <h1 class="m-0">Template Dokumen</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Master</li>
                    <li class="breadcrumb-item"><a href="#">Template Dokumen</a></li>
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
                                        <div class="card card-info card-outline card-tabs">
                                            <div class="tab-content" id="custom-tabs-six-tabContent">
                                                <div class="tab-pane fade show active" id="custom-tabs-six-riwayat-rm"
                                                    role="tabpanel" aria-labelledby="custom-tabs-six-riwayat-rm-tab">
                                                    <div class="card-body">
                                                        <div class="col-md-12">
                                                            {{-- <div class="card card-info card-outline"> --}}
                                                            <form class="mt-2 form-horizontal" wire:submit='save'>
                                                                <div class="card-body">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="mb-2 row">
                                                                                <label for="inputEmail3"
                                                                                    class="col-sm-2 col-form-label">Nama
                                                                                    <small
                                                                                        class="text-danger">*</small></label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        wire:model='form.nama'
                                                                                        placeholder="Nama"
                                                                                        @if ($edit) readonly @endif>
                                                                                    @error('form.nama')
                                                                                        <span
                                                                                            class="form-text text-danger">{{ $message }}</span>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="inputEmail3"
                                                                                    class="col-sm-2 col-form-label">Upload
                                                                                    File
                                                                                    <small class="text-danger">* <br>
                                                                                        <b>(format file :
                                                                                            docx |
                                                                                            doc)</b></small></label>
                                                                                <div class="col-sm-10">
                                                                                    <div x-data="{ uploading: false, progress: 0 }"
                                                                                        x-on:livewire-upload-start="uploading = true"
                                                                                        x-on:livewire-upload-finish="uploading = false"
                                                                                        x-on:livewire-upload-cancel="uploading = false"
                                                                                        x-on:livewire-upload-error="uploading = false"
                                                                                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                                                        <input type="file"
                                                                                            wire:model.live="files"
                                                                                            class="form-control"
                                                                                            accept=".doc, .docx">
                                                                                        @error('files')
                                                                                            <span
                                                                                                class="form-text text-danger">{{ $message }}</span>
                                                                                        @enderror
                                                                                        <div x-show="uploading">
                                                                                            <progress max="100"
                                                                                                x-bind:value="progress"></progress>
                                                                                            <span
                                                                                                x-text="progress"><!-- Will output: "bar" -->
                                                                                            </span> %
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    <div wire:loading
                                                                                        wire:target="save">
                                                                                        <i class="fa fa-spinner fa-spin"
                                                                                            style="font-size:24px"></i>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                    <div class="mt-3 card-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-info">Simpan</button>
                                                                    </div>
                                                            </form>
                                                        </div>
                                                        <br>

                                                        <div class="card card-info card-outline">
                                                            <div class="card-header">
                                                                <div class="card-title">
                                                                    Template Dokumen
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-2">
                                                                        <input type="text" class="form-control"
                                                                            placeholder="cari" wire:model.live='cari'>
                                                                    </div>
                                                                </div>

                                                                <div class="table-responsive">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <th>No</th>
                                                                            <th>Nama</th>
                                                                            <th>File</th>
                                                                            <th>Aksi</th>
                                                                        </thead>
                                                                        <tbody>
                                                                            @foreach ($post as $item)
                                                                                <tr wire:key='{{ $item->id }}'>
                                                                                    <td>{{ $loop->index + $post->firstItem() }}
                                                                                    </td>
                                                                                    <td> {{ $item->nama ?? '-' }}</td>
                                                                                    <td>
                                                                                        <div class="list-icons">
                                                                                            <a href="{{ asset('storage/' . $item->path) }}"
                                                                                                class="btn btn-info rounded-round btn-sm"
                                                                                                target="_blank"><i
                                                                                                    class="fas fa-file-word mr-2"></i>Lihat
                                                                                                File</a>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div
                                                                                            class="gap-3 table-actions d-flex align-items-center fs-6">
                                                                                            <div class="mr-2">
                                                                                                <button type="button"
                                                                                                    wire:click="getEdit('{{ $item->id }}')"
                                                                                                    class="btn btn-warning btn-flat btn-sm"
                                                                                                    data-toggle="tooltip"
                                                                                                    data-placement="left"
                                                                                                    title="Edit"><i
                                                                                                        class="fas fa-pencil-alt"></i>
                                                                                                </button>
                                                                                                {{-- <button type="button"
                                                                                                    class="btn btn-danger btn-flat btn-sm"
                                                                                                    wire:click="delete('{{ $item->id }}')"><i
                                                                                                        class="fas fa-trash"></i>
                                                                                                </button> --}}
                                                                                            </div>
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
