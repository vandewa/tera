<?php

namespace App\Livewire\Component\Badges;

use App\Models\Pengajuan;
use Livewire\Component;

class PermohonanBadges extends Component
{
    public function render()
    {
        $data = Pengajuan::where('pengajuan_st', 'PENGAJUAN_ST_01')->count();

        return view('livewire.component.badges.permohonan-badges', [
            'data' => $data
        ]);
    }
}
