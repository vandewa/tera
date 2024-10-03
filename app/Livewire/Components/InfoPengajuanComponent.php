<?php

namespace App\Livewire\Components;

use App\Models\DokumenPemeriksaan;
use Livewire\Component;
use App\Models\Pemeriksaan;
use App\Models\Pengajuan;
use Livewire\WithFileUploads;

class InfoPengajuanComponent extends Component
{
    use WithFileUploads;

    public $idnya, $kartuOrder, $skhp, $pemeriksaan, $wa;

    public function mount($id)
    {
        $this->idnya = $id;

        $this->pemeriksaan = Pemeriksaan::with(['pengajuan.user', 'standar', 'petugas', 'penandatangan', 'hasil', 'berhak'])->where('pengajuan_id', $this->idnya)->first();

        $this->wa = $this->pemeriksaan->pengajuan->user->wa;

    }

    public function save()
    {
        // $this->validate([
        //     // 'kartuOrder' => 'required',
        //     // 'skhp' => 'required',
        // ]);

        if ($this->kartuOrder) {
            $path_kartu_order = $this->kartuOrder->store('tera/dokumen-pemeriksaan', 'gcs');
            DokumenPemeriksaan::create([
                'pemeriksaan_id' => $this->pemeriksaan->id,
                'jenis_dokumen_tp' => 'JENIS_DOKUMEN_TP_02',
                'path' => $path_kartu_order,
            ]);
        }

        if ($this->skhp) {
            $path_skhp = $this->skhp->store('tera/dokumen-pemeriksaan', 'gcs');
            DokumenPemeriksaan::create([
                'pemeriksaan_id' => $this->pemeriksaan->id,
                'jenis_dokumen_tp' => 'JENIS_DOKUMEN_TP_01',
                'path' => $path_skhp,
            ]);
        }


        $this->showSuccessMessage('You clicked the button!');

        $this->kartuOrder = null;
        $this->skhp = null;

    }

    private function showSuccessMessage($message)
    {
        $this->js(<<<JS
        Swal.fire({
            title: 'Good job!',
            text: '$message',
            icon: 'success',
        })
        JS);
    }

    public function finish()
    {
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Apakah kamu ingin menyelesaikan permohonan tera ini? proses ini tidak dapat dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.selesai()
            }
        })
        JS);
    }

    public function selesai()
    {
        Pengajuan::find($this->idnya)->update([
            'pengajuan_st' => 'PENGAJUAN_ST_05'
        ]);

        $pesan = '*Notifikasi*' . urldecode('%0D%0A%0D%0A') .
            'Pengajuan tera *Selesai*. Terima kasih atas kerjasama dan kepercayaan Anda. Jika Anda memerlukan bantuan lebih lanjut atau informasi tambahan, jangan ragu untuk menghubungi kami. Semoga hari Anda menyenangkan!' . urldecode('%0D%0A%0D%0A') .
            'Disdagkopukm Wonosobo'
        ;

        // kirimPesan::dispatch($this->wa, $pesan);


        $this->showSuccessMessage('You clicked the button!');

    }

    public function render()
    {
        $data = Pemeriksaan::with(['pengajuan.user', 'standar', 'petugas', 'penandatangan', 'hasil', 'berhak', 'telusurannya', 'metodenya'])->where('pengajuan_id', $this->idnya)->first();

        $pathKartuOrder = DokumenPemeriksaan::where('pemeriksaan_id', $this->pemeriksaan->id)->where('jenis_dokumen_tp', 'JENIS_DOKUMEN_TP_01')->first();

        $pathSkhp = DokumenPemeriksaan::where('pemeriksaan_id', $this->pemeriksaan->id)->where('jenis_dokumen_tp', 'JENIS_DOKUMEN_TP_02')->first();


        return view('livewire.components.info-pengajuan-component', [
            'items' => $data,
            'pathKartuOrder' => $pathKartuOrder,
            'pathSkhp' => $pathSkhp,
        ]);
    }
}
