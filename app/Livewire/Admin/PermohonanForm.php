<?php

namespace App\Livewire\Admin;

use App\Jobs\kirimPesan;
use App\Models\User;
use App\Models\ComCode;
use App\Models\Pemohon;
use Livewire\Component;
use App\Models\Pengajuan;
use App\Models\JadwalTera;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use App\Models\PengajuanUttp;
use App\Models\Uttp as ModelUttp;

class PermohonanForm extends Component
{
    use WithPagination;

    public $idHapus, $edit = false, $idnya, $cari, $bukaAlamat, $user;

    public $form = [
        'pengajuan_tp' => null,
        'alamat' => null,
        'jadwal_tera_id' => null,
        'user_id' => null,
    ];

    public $formUttp = [

    ];



    public function mount($id = "")
    {
        if (count($this->formUttp) < 1) {
            $this->tambahUttp();
        }

        if ($id) {
            $data = Pengajuan::find($id); // Fetch the Pengajuan model instance
            $this->idnya = $id;

            if ($data) { // Check if the data exists
                $this->form = $data->only(['pengajuan_tp', 'alamat', 'jadwal_tera_id', 'user_id']);
                $this->formUttp = $data->uttpItem->toArray(); // Fetch related records and convert to array

                // Form alamat
                $this->bukaAlamat = $this->form['pengajuan_tp'] === 'PENGAJUAN_TP_02';

                // Modal pemohon
                $this->user = User::find($this->form['user_id']);
            }

            $this->edit = true;

        }
    }


    #[On('pilih-user')]
    public function pilihUser($id = "")
    {
        $this->user = User::find($id);
        $this->form['user_id'] = $this->user->id;
    }

    public function hapusUttp($index)
    {
        unset($this->formUttp[$index]);
    }

    public function updated($property)
    {
        if ($property === 'form.pengajuan_tp') {
            if ($this->form['pengajuan_tp'] === "PENGAJUAN_TP_02") {
                $this->bukaAlamat = true;
            } else {
                $this->bukaAlamat = false;
                $this->form['alamat'] = null;
            }
        }
    }

    public function save()
    {

        $this->validate([
            'formUttp.*.uttp_id' => 'required',
            'formUttp.*.jumlah' => 'required',
            'form.pengajuan_tp' => 'required',
            'form.alamat' => 'required_if:form.pengajuan_tp,PENGAJUAN_TP_02',
        ]);

        if ($this->edit) {
            $this->storeUpdate();
        } else {
            $this->store();
        }

        $this->redirect(Permohonan::class);
        $this->js(<<<JS
            Swal.fire({
            title: "Berhasil!",
            text: "Anda berhasil mengajukan tera!",
            icon: "success"
            });
        JS);

        $pesan = '*Notifikasi*' . urldecode('%0D%0A%0D%0A') .
            'Pengajuan tera telah berhasil! Mohon menunggu notifikasi selanjutnya, Terima kasih atas kesabaran Anda.' . urldecode('%0D%0A%0D%0A') .
            'Disdagkopukm Wonosobo'
        ;

        // kirimPesan::dispatch(auth()->user()->wa, $pesan);

    }

    public function store()
    {
        $a = Pengajuan::create([
            // 'user_id' => auth()->user()->id,
            'order_no' => genNo(),
            'pengajuan_st' => 'PENGAJUAN_ST_01',
        ] + $this->form);

        foreach ($this->formUttp as $item) {
            $a->uttpItem()->create($item);
        }

    }

    public function storeUpdate()
    {
        // Find the Pengajuan record and update it
        $pengajuan = Pengajuan::find($this->idnya);
        $pengajuan->update($this->form);

        // Delete existing uttpItems
        $pengajuan->uttpItem()->delete();

        // Create new uttpItems
        foreach ($this->formUttp as $item) {
            $pengajuan->uttpItem()->create($item);
        }
    }

    public function tambahUttp()
    {
        $data = [
            'uttp_id' => null,
            'no_seri' => null,
            'merek' => null,
            'tipe' => null,
            'kapasitas' => null,
            'jumlah' => null,
        ];
        array_push($this->formUttp, $data);
    }


    public function render()
    {
        $data = ModelUttp::all();
        $jenisPengajuan = ComCode::where('code_group', 'PENGAJUAN_TP')->get();
        $jadwal = JadwalTera::where('jadwal_tera_st', 'JADWAL_TERA_ST_01')->get();
        $user = User::all();

        return view('livewire.admin.permohonan-form', [
            'uttp' => $data,
            'uttpForm' => $this->formUttp,
            'jenisPengajuan' => $jenisPengajuan,
            'jadwal' => $jadwal,
            'user' => $user,
        ]);
    }
}
