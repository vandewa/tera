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
       $this->isian = Pengajuan::with(['statusPengajuan', 'jenisPengajuan'])->find($id);
    }
    public function render()
    {
        return view('livewire.proses-permohonan-page');
    }

    #[On('restart')]
    public function restart() {

    }

    public function confirmPembatalan() {
            $this->js(<<<'JS'
            Swal.fire({
                title: "Anda yakin?",
                text: "Status akan dirubah menjadi menunggu persetujuan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                cancelButtonText: "Batal",
                confirmButtonText: "Ya, Rubah status!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $wire.rubahStatus()
                }
                });
            JS);
    }

    public function rubahStatus() {
        $this->isian->update(['pengajuan_st' => 'PENGAJUAN_ST_01']);

        $this->js(<<<'JS'
          Swal.fire({
                    title: "Berhasil!",
                    text: "Data Berhasil dirubah.",
                    icon: "success"
                    });
        JS);
    }
}
