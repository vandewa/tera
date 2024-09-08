<?php

namespace App\Livewire\Components;

use App\Models\Pemeriksaan;
use Livewire\Component;

class InfoPengajuanComponent extends Component
{
    public function render()
    {
        $data = Pemeriksaan::with(['pengajuan.user', 'standar', 'petugas', 'penandatangan', 'hasil'])->first();
        return view('livewire.components.info-pengajuan-component',
    ['items' => $data]);
    }
}
