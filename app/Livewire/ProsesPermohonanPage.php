<?php

namespace App\Livewire;

use Livewire\Component;

class ProsesPermohonanPage extends Component
{
    public $idnya;
    public function mount($id) {
        $this->idnya = $id;
    }
    public function render()
    {
        return view('livewire.proses-permohonan-page');
    }
}
