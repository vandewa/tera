<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\ComCode;
use Livewire\Component;
use App\Models\Peralatan;
use App\Models\JadwalTeraPetugas;
use App\Models\JadwalTeraPeralatan;
use App\Models\JadwalTera as ModelJadwalTera;


class DetailJadwalTera extends Component
{
    public $idHapus, $edit = false, $idnya, $cari, $jadwalTera, $listJadwalTera;

    public $form = [
        'lokasi' => null,
        'tanggal_mulai' => null,
        'tanggal_selesai' => null,
        'no_sk' => null,
        'jadwal_tera_st' => null,
    ];
    public $formPetugas = [
        'jadwal_tera_id' => null,
        'user_id' => null,
    ];

    public $formPeralatan = [
        'jadwal_tera_id' => null,
        'peralatan_id' => null,
        'kembali_st' => null,
    ];

    public function mount($id = '')
    {
        if ($id) {
            $this->jadwalTera = $id;
            $this->form = ModelJadwalTera::find($id)->only(['lokasi', 'tanggal_mulai', 'tanggal_selesai', 'no_sk', 'jadwal_tera_st']);
            $this->listJadwalTera = ComCode::where('code_group', 'JADWAL_TERA_ST')->get()->toArray();

        }
    }

    public function savePetugas()
    {
        $this->formPetugas['jadwal_tera_id'] = $this->jadwalTera;
        JadwalTeraPetugas::create($this->formPetugas);

        $this->showSuccessMessage('Anda berhasil menambah petugas!');
        $this->resetForm();
    }

    public function savePeralatan()
    {
        $this->formPeralatan['jadwal_tera_id'] = $this->jadwalTera;
        JadwalTeraPeralatan::create($this->formPeralatan);

        $this->showSuccessMessage('Anda berhasil menambah peralatan!');
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset('formPetugas');
        $this->reset('formPeralatan');
    }

    public function hapusPetugas($id)
    {
        $this->idHapus = $id;
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Apakah kamu ingin menghapus data ini? proses ini tidak dapat dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.deletePetugas()
            }
        })
        JS);
    }

    public function hapusPeralatan($id)
    {
        $this->idHapus = $id;
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Apakah kamu ingin menghapus data ini? proses ini tidak dapat dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $wire.deletePeralatan()
            }
        })
        JS);
    }

    public function deletePetugas()
    {
        JadwalTeraPetugas::where('user_id', $this->idHapus)->delete();
        $this->showSuccessMessage('Data has been deleted successfully!');
    }

    public function deletePeralatan()
    {
        // JadwalTeraPetugas::where('user_id', $this->idHapus)->delete();
        // $this->showSuccessMessage('Data has been deleted successfully!');
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



    // public function save()
    // {
    //     $this->validate([
    //         'formUttp.*.uttp_id' => 'required',
    //         'formUttp.*.jumlah' => 'required',
    //         'form.pengajuan_tp' => 'required',
    //         'form.alamat' => 'required_if:form.pengajuan_tp,PENGAJUAN_TP_02',
    //     ]);

    //     $a = Pengajuan::create([
    //         'user_id' => auth()->user()->id,
    //         'order_no' => genNo(),
    //         'pengajuan_st' => 'PENGAJUAN_ST_01',
    //     ] + $this->form);

    //     foreach ($this->formUttp as $item) {
    //         $a->uttpItem()->create($item);
    //     }


    //     $this->redirect(PermohonanPage::class);
    //     $this->js(<<<JS
    //         Swal.fire({
    //         title: "Berhasil!",
    //         text: "Anda berhasil meengajuak tera!",
    //         icon: "success"
    //         });
    //     JS);
    // }


    public function render()
    {
        $data = User::all();
        $peralatan = Peralatan::all();

        $userPetugas = User::whereHas('jadwal', function ($a) {
            $a->where('jadwal_tera_id', $this->jadwalTera);
        })->get();

        $userPeralatan = JadwalTeraPeralatan::whereHas('jadwal', function ($a) {
            $a->where('jadwal_tera_id', $this->jadwalTera);
        })->get();


        return view('livewire.detail-jadwal-tera', [
            'petugas' => $data,
            'petugasForm' => $this->formPetugas,
            'userPetugas' => $userPetugas,
            'peralatan' => $peralatan,
            'userPeralatan' => $userPeralatan,
        ]);
    }
}

