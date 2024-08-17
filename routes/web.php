<?php

use App\Http\Controllers\RegisterController;
use App\Http\Middleware\CheckNik;
use App\Livewire\User;
use App\Livewire\Dashboard;
use App\Livewire\DataDiri;
use App\Livewire\PemohonCrud;
use App\Livewire\Permohonan\PermohonanFormPage;
use App\Livewire\Permohonan\PermohonanPage;
use App\Livewire\UserIndex;
use App\Livewire\Uttp;
use Illuminate\Support\Facades\Route;

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
    Route::get('permohonan/create', PermohonanFormPage::class)->name('permohonan.create');
    Route::get('data-diri', DataDiri::class)->name('data-diri');
    Route::post('/registerr', [RegisterController::class, 'store'])->name('register.store');


    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::get('user-index', UserIndex::class)->name('user-index');
        Route::get('uttp', Uttp::class)->name('uttp');
        Route::get('user/{id?}', User::class)->name('user');
    });
});


