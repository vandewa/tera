<div>
    <div class="card border rounded shadow-sm mb-3">
        <div class="card-header ui-sortable-handle" style="cursor: move;">
            <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                Informasi jadwal Tera
            </h3>
        </div>
        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Lokasi:</strong> {{ $jadwalTera->lokasi }}
                        </li>
                        <li class="list-group-item">
                            <strong>Tanggal Mulai:</strong>
                            {{ \Carbon\Carbon::parse($jadwalTera->tanggal_mulai)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        </li>
                        <li class="list-group-item">
                            <strong>Tanggal Selesai:</strong>
                            {{ \Carbon\Carbon::parse($jadwalTera->tanggal_selesai)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                        </li>
                    </ul>

                </div>
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>No SK:</strong> {{ $jadwalTera->no_sk }}</li>

                        <li class="list-group-item"><strong>Status:</strong>

                            <span
                                class="badge {{ $jadwalTera->jadwal_tera_st == 'JADWAL_TERA_ST_01' ? 'bg-success' : 'bg-danger' }}">
                                {{ $jadwalTera->status->code_nm }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>
