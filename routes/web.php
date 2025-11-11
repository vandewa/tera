<?php

use App\Livewire\User;
use App\Livewire\Uttp;
use App\Livewire\Metode;
use App\Livewire\DataDiri;
use App\Livewire\Dashboard;
use App\Livewire\Peralatan;
use App\Livewire\UserIndex;
use App\Livewire\JadwalTera;
use App\Livewire\PemohonCrud;
use App\Livewire\UserUttpPage;
use App\Livewire\TemplateDokumen;
use App\Livewire\Admin\Permohonan;
use App\Livewire\Admin\SidangTera;
use App\Livewire\DetailJadwalTera;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\PermohonanForm;
use App\Livewire\Admin\SidangTeraForm;
use App\Livewire\ProsesPermohonanPage;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\LaporanController;
use App\Livewire\Permohonan\PermohonanPage;
use App\Http\Controllers\RegisterController;
use App\Livewire\Admin\ProsesSidangTeraPage;
use App\Livewire\Permohonan\PermohonanFormPage;
use App\Http\Controllers\PasswordResetController;
use App\Livewire\DetailPermohonanPage;
use App\Livewire\JadwalTeraPeserta;
use App\Livewire\SidangTeraBeritaAcara;
use App\Livewire\Standar;
use App\Livewire\Telusuran;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('show-picture', [HelperController::class, 'showPicture'])->name('helper.show-picture');
Route::get('password-reset', [PasswordResetController::class, 'index'])->name('password.index');
Route::post('password-reset', [PasswordResetController::class, 'updatePassword'])->name('password.post');
Route::get('/registrasi', [RegisterController::class, 'index'])->name('registrasi.index');
Route::post('/registrasi', [RegisterController::class, 'store'])->name('registrasi.store');

Route::get('a', [CetakController::class, 'generateData'])->name('helper.generate-data');
Route::get('b', [CetakController::class, 'cetakOrder'])->name('helper.cetak-order');
Route::get('c/{id?}', [CetakController::class, 'cetakSkhp'])->name('helper.cetak-skhp');



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',

])->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('my-uttp', UserUttpPage::class)->name('user-uttp');
    Route::get('pemohon', PemohonCrud::class)->name('pemohon');
    Route::get('permohonan', PermohonanPage::class)->name('permohonan');
    Route::get('permohonan/proses/{id}', ProsesPermohonanPage::class)->name('permohonan-proses');
    Route::get('permohonan/create/{id?}', PermohonanFormPage::class)->name('permohonan.create');
    Route::get('data-diri', DataDiri::class)->name('data-diri');
    Route::get('jadwal-tera', JadwalTera::class)->name('jadwal-tera');
    Route::get('jadwal-tera-peserta/{id?}', JadwalTeraPeserta::class)->name('jadwal-tera-peserta');
    Route::get('detail-jadwal-tera/{id?}', DetailJadwalTera::class)->name('detail-jadwal-tera');
    Route::get('laporan/rekap', [LaporanController::class, 'rekap'])->name('rekap');
    Route::post('laporan/triwulan', [LaporanController::class, 'storeTriwulan'])->name('store.triwulan');
    Route::post('laporan/global', [LaporanController::class, 'storeGlobal'])->name('store.global');
    Route::get('laporan/sidang', [LaporanController::class, 'rekapSidang'])->name('laporan.rekap-sidang');
    Route::get('laporan/ba', [CetakController::class, 'baCetak'])->name('laporan.ba-cetak');
    Route::post('laporan/rekap-pelayanan', [LaporanController::class, 'rekapPelayanan'])->name('laporan.rekap-pelayanan');
    Route::post('laporan/rekap-sidang-tera-ulang', [LaporanController::class, 'rekapSidangTeraUlang'])->name('laporan.rekap-sidang-tera-ulang');
    Route::get('permohonan/show/{id}', DetailPermohonanPage::class)->name('permohonan.detail.show');

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('permohonan/{id?}', Permohonan::class)->name('permohonan');
        Route::get('permohonan/create/{id?}', PermohonanForm::class)->name('permohonan.create');
        Route::get('sidang-tera', SidangTera::class)->name('sidang.tera');
        Route::get('sidang-tera/create/{id?}', SidangTeraForm::class)->name('sidang-tera.create');
        Route::get('sidang-tera/proses/{id}', ProsesSidangTeraPage::class)->name('sidang-tera.proses');
        Route::get('sidang-tera/berita-acara/{id}', SidangTeraBeritaAcara::class)->name('sidang-tera.berita-acara');

    });

    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::get('user-index', UserIndex::class)->name('user-index');
        Route::get('uttp', Uttp::class)->name('uttp');
        Route::get('peralatan', Peralatan::class)->name('peralatan');
        Route::get('metode', Metode::class)->name('metode');
        Route::get('standar', Standar::class)->name('standar');
        Route::get('telusuran', Telusuran::class)->name('telusuran');
        Route::get('user/{id?}', User::class)->name('user');
        Route::get('template-dokumen', TemplateDokumen::class)->name('template-dokumen');

    });
});


