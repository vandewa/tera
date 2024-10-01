<?php

namespace App\Livewire;

use App\Models\Uttp;
use Livewire\Component;

class JadwalTeraPeserta extends Component
{
    public $idnya;
    public $listUttp = [];
    public $uttpPeserta = [];
    public $form = [
        'nama' => null,
        'telepon' => null
    ];
    public function mount($id = "") {
        $this->idnya = $id;
        $this->listUttp = Uttp::all();
    }
    public function render()
    {
        return view('livewire.jadwal-tera-peserta');
    }
}
