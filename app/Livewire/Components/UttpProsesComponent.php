<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\PengajuanUttp;
use App\Models\Uttp;


class UttpProsesComponent extends Component
{
    public $pengajuanUttps;

    public function mount($id)
    {
        // Mengambil data dari tabel pengajuan_uttps beserta data dari tabel uttps
        $this->pengajuanUttps = PengajuanUttp::with('uttp')->where('pengajuan_id', $id)->get();
    }

    public function render()
    {
        return view('livewire.components.uttp-proses-component');
    }
}
