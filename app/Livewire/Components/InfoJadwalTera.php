<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\JadwalTera;

class InfoJadwalTera extends Component
{
    public JadwalTera $jadwalTera;

    public function mount($id = "")
    {
        // Mengambil satu instance JadwalTera, misalnya yang pertama
        $this->jadwalTera = JadwalTera::find($id);
    }
    public function render()
    {
        return view('livewire.components.info-jadwal-tera');
    }
}
