<div class="card card-info card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <!-- FontAwesome User Icon -->
            <i class="fas fa-user fa-3x"></i>
        </div>
        <h3 class="text-center profile-username">{{ $user->name }}</h3>
        <p class="text-center text-muted">{{ $user->nama_usaha }}</p>
        <ul class="mb-3 list-group list-group-unbordered">
            <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{ $user->email }}</a>
            </li>
            <li class="list-group-item">
                <b>NIK</b> <a class="float-right">{{ $user->nik }}</a>
            </li>
            <li class="list-group-item">
                <b>WA</b> <a class="float-right">{{ $user->wa }}</a>
            </li>
            <li class="list-group-item">
                <b>Alamat</b> <a class="float-right">{{ $user->alamat }}</a>
            </li>
            <li class="list-group-item">
                <b>Created At</b> <a class="float-right">{{ $user->created_at->format('d-m-Y H:i:s') }}</a>
            </li>
            <li class="list-group-item">
                <b>Updated At</b> <a class="float-right">{{ $user->updated_at->format('d-m-Y H:i:s') }}</a>
            </li>
        </ul>

    </div>
</div>
