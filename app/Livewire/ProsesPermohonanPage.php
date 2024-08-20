<?php

namespace App\Livewire;

use App\Models\Pengajuan;
use Livewire\Component;

use Livewire\Attributes\On;

class ProsesPermohonanPage extends Component
{
    public $idnya;
    public $isian;
    public function mount($id) {
        $this->idnya = $id;
       $this->isian = Pengajuan::with(['statusPengajuan'])->find($id);
    }
    public function render()
    {
        return view('livewire.proses-permohonan-page');
    }

    #[On('restart')]
    public function restart() {

    }
}
