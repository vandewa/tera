<?php

namespace App\Livewire\Components;

use App\Models\Pemeriksaan;
use Livewire\Component;

class InfoPengajuanComponent extends Component
{

    public $idnya;

    public function mount($id)
    {
        $this->idnya = $id;
    }

    public function render()
    {
        $data = Pemeriksaan::with(['pengajuan.user', 'standar', 'petugas', 'penandatangan', 'hasil', 'berhak'])->where('pengajuan_id', $this->idnya)->first();

        return view('livewire.components.info-pengajuan-component', ['items' => $data]);
    }
}
