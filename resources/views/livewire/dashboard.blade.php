<div>
    <div class="container">
        <x-slot name="header">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                    </ol>
                </div>
            </div>
        </x-slot>
        <div class="row">
            <div class="col-lg-3 col-6">

                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $permohonan }}</h3>
                        <p>Total Permohonan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-navicon-round"></i>
                    </div>
                    <a href="{{ route('admin.permohonan') }}" class="small-box-footer">More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $uttp }}</h3>
                        <p>Total UTTP</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('master.uttp') }}" class="small-box-footer">More info
                        <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-3 col-6">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $peralatan }}</h3>
                        <p>Total Peralatan</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-briefcase"></i>
                    </div>
                    <a href="{{ route('master.peralatan') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $user }}</h3>
                        <p>Total User</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                    <a href="{{ route('master.user') }}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
    </div>
    <livewire:chart.uttp-chart>
</div>
