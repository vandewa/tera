<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Jobs\kirimPesan;
use App\Models\Pengajuan;
use App\Livewire\Admin\Permohonan;
use App\Livewire\ProsesPermohonanPage;

class FormPersetujuanComponent extends Component
{
    public $idnya, $wa;

    public function mount()
    {
        $a = Pengajuan::with(['jenisPengajuan', 'pemohon'])->find($this->idnya);
        $this->wa = $a->pemohon->wa;
    }

    public function render()
    {

        $data = Pengajuan::with(['jenisPengajuan', 'pemohon'])->find($this->idnya);
        return view('livewire.components.form-persetujuan-component', [
            'data' => $data
        ]);
    }

    public function terima()
    {
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

    public function terimaPermohonan()
    {
        Pengajuan::find($this->idnya)->update([
            'pengajuan_st' => 'PENGAJUAN_ST_02'
        ]);

        $pesan = '*Notifikasi*' . urldecode('%0D%0A%0D%0A') .
            'Status pengajuan tera *DITERIMA*. Mohon menunggu notifikasi selanjutnya, Terima kasih atas kesabaran Anda.' . urldecode('%0D%0A%0D%0A') .
            'Disdagkopukm Wonosobo'
        ;

        // kirimPesan::dispatch($this->wa, $pesan);

        $this->refreshPage();
    }
    public function tolak()
    {
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

    public function tolakPermohonan()
    {
        Pengajuan::find($this->idnya)->update([
            'pengajuan_st' => 'PENGAJUAN_ST_03'
        ]);

        $pesan = '*Notifikasi*' . urldecode('%0D%0A%0D%0A') .
            'Pengajuan tera Anda saat ini *DITOLAK*. Kami mohon maaf atas ketidaknyamanan ini. Tim kami akan segera menghubungi Anda untuk memberikan informasi lebih lanjut dan panduan terkait langkah berikutnya. Terima kasih atas pengertian Anda.' . urldecode('%0D%0A%0D%0A') .
            'Disdagkopukm Wonosobo'
        ;

        // kirimPesan::dispatch($this->wa, $pesan);


        $this->refreshPage();
    }

    public function refreshPage()
    {
        $this->dispatch('restart');
    }
}
