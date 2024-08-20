<?php

namespace App\Livewire\Components;

use App\Livewire\Admin\Permohonan;
use Livewire\Component;
use App\Models\Pengajuan;

class FormPersetujuanComponent extends Component
{
    public $idnya;
    public function render()
    {

        $data = Pengajuan::with(['jenisPengajuan', 'pemohon'])->find($this->idnya);
        return view('livewire.components.form-persetujuan-component',[
            'data' => $data
        ]);
    }

    public function terima() {
        $this->js(<<<'JS'
            Swal.fire({
            title: "Anda yakin akan menirma permohonan ini?",
            text: "Anda tidak bisa merubah data!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya Terima!"
            }).then((result) => {
            if (result.isConfirmed) {
                $wire.terimaPermohonan()
                // Swal.fire({
                // title: "Deleted!",
                // text: "Your file has been deleted.",
                // icon: "success"
                // });
            }
            });
        JS);
    }

    public function terimaPermohonan() {
        Pengajuan::find($this->idnya)->update([
            'pengajuan_st' => 'PENGAJUAN_ST_02'
        ]);
    }
    public function tolak()  {
        $this->js(<<<'JS'
        Swal.fire({
        title: "Anda yakin akan menolak permohonan ini?",
        text: "Anda tidak bisa merubah data!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya Saya Menolak!"
        }).then((result) => {
        if (result.isConfirmed) {
            $wire.tolakPermohonan()
            // Swal.fire({
            // title: "Deleted!",
            // text: "Your file has been deleted.",
            // icon: "success"
            // });
        }
        });
    JS);
    }

    public function tolakPermohonan() {
        Pengajuan::find($this->idnya)->update([
            'pengajuan_st' => 'PENGAJUAN_ST_03'
        ]);
    }
}
