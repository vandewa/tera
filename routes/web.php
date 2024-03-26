<?php

use App\Livewire\User;
use App\Livewire\Dashboard;
use App\Livewire\DataDiri;
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
    Route::get('data-diri', DataDiri::class)->name('data-diri');

    Route::group(['prefix' => 'master', 'as' => 'master.'], function () {
        Route::get('user-index', UserIndex::class)->name('user-index');
        Route::get('uttp', Uttp::class)->name('uttp');
        Route::get('user/{id?}', User::class)->name('user');
    });
});


