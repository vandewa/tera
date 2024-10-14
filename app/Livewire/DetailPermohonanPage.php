<?php

namespace App\Livewire;

use App\Models\PengajuanUttp;
use Livewire\Component;

class DetailPermohonanPage extends Component
{

    public $idnya;
    public function mount($id) {
        $this->idnya = $id;
    }
    public function render()
    {
        $uttp =  PengajuanUttp::with([
            'uttp',
            'pengajuannya',
            'hasil'
        ])->where('pengajuan_id', $this->idnya)->get();
        return view('livewire.detail-permohonan-page', [
            'data' => $uttp
        ]);
    }
}
