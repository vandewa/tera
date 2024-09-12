<?php

namespace App\Livewire;

use App\Models\Pengajuan;
use App\Models\Peralatan;
use App\Models\User;
use App\Models\Uttp;
use Livewire\Component;

class Dashboard extends Component
{

    public function mount()
    {
        if (auth()->user()->hasRole('user')) {
            return redirect(route('data-diri'));
        }
    }
    public function render()
    {
        $permohonan = Pengajuan::count();
        $uttp = Uttp::count();
        $peralatan = Peralatan::count();
        $user = User::count();

        return view('livewire.dashboard', [
            'permohonan' => $permohonan,
            'uttp' => $uttp,
            'peralatan' => $peralatan,
            'user' => $user,
        ]);
    }
}
