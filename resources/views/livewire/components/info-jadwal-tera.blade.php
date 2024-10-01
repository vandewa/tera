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
                        <li class="list-group-item"><strong>Lokasi:</strong> {{ $jadwalTera->lokasi }}</li>
                        <li class="list-group-item"><strong>Tanggal Mulai:</strong>
                            {{ $jadwalTera->tanggal_mulai }}</li>
                        <li class="list-group-item"><strong>Tanggal Selesai:</strong>
                            {{ $jadwalTera->tanggal_selesai }}</li>

                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>No SK:</strong> {{ $jadwalTera->no_sk }}</li>

                        <li class="list-group-item"><strong>Status:</strong>
                            <span
                                class="badge {{ $jadwalTera->jadwal_tera_st == 'Aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ $jadwalTera->jadwal_tera_st }}</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


</div>
