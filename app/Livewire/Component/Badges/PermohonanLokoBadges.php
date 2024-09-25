<?php

namespace App\Livewire\Component\Badges;

use App\Models\Pengajuan;
use Livewire\Component;

class PermohonanLokoBadges extends Component
{
    public function render()
    {
        $data = Pengajuan::where('pengajuan_st', 'PENGAJUAN_ST_01')
            ->where('jadwal_tera_id', null)
            ->where('pengajuan_tp', 'PENGAJUAN_TP_02')
            ->count();

        return view('livewire.component.badges.permohonan-loko-badges', [
            'data' => $data
        ]);
    }
}
