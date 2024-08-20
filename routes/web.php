<?php

use App\Livewire\User;
use App\Livewire\Uttp;
use App\Livewire\DataDiri;
use App\Livewire\Dashboard;
use App\Livewire\Peralatan;
use App\Livewire\UserIndex;
use App\Livewire\JadwalTera;
use App\Livewire\Admin\Permohonan;
use App\Livewire\DetailJadwalTera;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PermohonanForm;
use App\Livewire\Permohonan\PermohonanPage;
use App\Http\Controllers\RegisterController;
use App\Livewire\Permohonan\PermohonanFormPage;
use App\Livewire\PemohonCrud;
use App\Livewire\ProsesPermohonanPage;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('pemohon', PemohonCrud::class)->name('pemohon');
    Route::get('permohonan', PermohonanPage::class)->name('permohonan');
    Route::get('permohonan/proses/{id}', ProsesPermohonanPage::class)->name('permohonan-proses');
    Route::get('permohonan/create', PermohonanFormPage::class)->name('permohonan.create');
    Route::get('data-diri', DataDiri::class)->name('data-diri');
    Route::post('/registerr', [RegisterController::class, 'store'])->name('register.store');
    Route::get('jadwal-tera', JadwalTera::class)->name('jadwal-tera');
    Route::get('detail-jadwal-tera/{id?}', DetailJadwalTera::class)->name('detail-jadwal-tera');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('permohonan', Permohonan::class)->name('permohonan');
        Route::get('permohonan/create/{id?}', PermohonanForm::class)->name('permohonan.create');
    });

    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::get('user-index', UserIndex::class)->name('user-index');
        Route::get('uttp', Uttp::class)->name('uttp');
        Route::get('peralatan', Peralatan::class)->name('peralatan');
        Route::get('user/{id?}', User::class)->name('user');
    });
});


