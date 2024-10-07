<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;
use App\Jobs\kirimPesan;
use App\Models\Pengajuan;
use App\Models\Pemeriksaan;
use App\Livewire\Admin\Permohonan;
use App\Models\PemeriksaanPetugas;
use App\Livewire\ProsesPermohonanPage;

class FormPersetujuanComponent extends Component
{
    public $idnya, $wa;
    public $petugas = [];
    public $hapusPetugas = [];
    public $users = [];

    public function mount()
    {
        $a = Pengajuan::with(['jenisPengajuan', 'pemohon'])->find($this->idnya);
        $this->wa = $a->pemohon->wa;
        $this->users = User::whereHasRole(['penera', 'administrator', 'superadministrator'])->get();
    }

    public function addPetugas()
    {

        $this->petugas[] = ['user_id' => ''];
    }

    public function removePetugas($index)
    {
        if ($this->petugas[$index]['id'] ?? null) {
            array_push($this->hapusPetugas, $this->petugas[$index]['id']);
        }
        unset($this->petugas[$index]);
        $this->petugas = array_values($this->petugas);
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
        $this->validate([
            'petugas.*.user_id' => 'required'
        ]);

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
        $data = Pengajuan::find($this->idnya);

        $cekPemeriksaan = Pemeriksaan::where('pengajuan_id', $this->idnya)->first();

        if (!$cekPemeriksaan) {
            $cekPemeriksaan = Pemeriksaan::create([
                'pengajuan_id' => $this->idnya,
            ]);
        }

        $data->update([
            'pengajuan_st' => 'PENGAJUAN_ST_02'
        ]);

        foreach ($this->petugas as $petugas) {
            PemeriksaanPetugas::updateOrCreate(
                ['id' => $petugas['id'] ?? null],
                ['pemeriksaan_id' => $cekPemeriksaan->id, 'user_id' => $petugas['user_id']]
            );
        }

        $pesan = '*Notifikasi*' . urldecode('%0D%0A%0D%0A') .
            'Status pengajuan tera diterima dan saat ini pada tahap *Proses Pemeriksaan*. Mohon menunggu notifikasi selanjutnya, Terima kasih atas kesabaran Anda.' . urldecode('%0D%0A%0D%0A') .
            'Disdagkopukm Wonosobo'
        ;

        kirimPesan::dispatch($this->wa, $pesan);

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
            'Pengajuan tera Anda *Ditolak*. Kami mohon maaf atas ketidaknyamanan ini. Tim kami akan segera menghubungi Anda untuk memberikan informasi lebih lanjut dan panduan terkait langkah berikutnya. Terima kasih atas pengertian Anda.' . urldecode('%0D%0A%0D%0A') .
            'Disdagkopukm Wonosobo'
        ;

        kirimPesan::dispatch($this->wa, $pesan);


        $this->refreshPage();
    }

    public function refreshPage()
    {
        $this->dispatch('restart');
    }
}
