<?php

namespace App\Livewire\Permohonan;

use App\Models\ComCode;
use App\Models\Pemohon;
use App\Models\Pengajuan;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Uttp as ModelUttp;

class PermohonanFormPage extends Component
{
    use WithPagination;

    public $idHapus, $edit = false, $idnya, $cari, $bukaAlamat;

    public $form = [
        'pengajuan_tp' => null,
        'alamat' => null,
        'tanggal' => null,
    ];

    public $formUttp = [

    ];

    public function updated($property)
    {
        // $property: The name of the current property that was updated

        if ($property === 'form.pengajuan_tp') {
            if ($this->form['pengajuan_tp'] === "PENGAJUAN_TP_02") {
                $this->bukaAlamat = true;
            } else {
                $this->bukaAlamat = false;
                $this->form['alamat'] = null;
            }
        }
    }

    public function mount($id = "")
    {

        $this->form['tanggal'] = date('Y-m-d');

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

            }

            $this->edit = true;

        }
    }

    public function hapusUttp($index)
    {
        unset($this->formUttp[$index]);
    }

    public function save()
    {

        $this->validate([
            'formUttp.*.uttp_id' => 'required',
            'formUttp.*.jumlah' => 'required',
            'form.pengajuan_tp' => 'required',
            'form.tanggal' => 'required',
            'form.alamat' => 'required_if:form.pengajuan_tp,PENGAJUAN_TP_02',
        ]);

        if ($this->edit) {
            $this->storeUpdate();
        } else {
            $this->store();
        }

        $this->js(<<<JS
            Swal.fire({
            title: "Berhasil!",
            text: "Anda berhasil mengajukan tera!",
            icon: "success"
            });
        JS);
        $this->redirect(PermohonanPage::class);

    }

    public function store()
    {
        $a = Pengajuan::create([
            'user_id' => auth()->user()->id,
            'order_no' => genNo(),
            'pengajuan_st' => 'PENGAJUAN_ST_01',
            'tanggal' => $this->form['tanggal'],
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
            'keterangan' => null,
        ];
        array_push($this->formUttp, $data);
    }


    public function render()
    {
        $data = ModelUttp::all();
        $jenisPengajuan = ComCode::where('code_group', 'PENGAJUAN_TP')->get();

        return view('livewire.permohonan.permohonan-form-page', [
            'uttp' => $data,
            'uttpForm' => $this->formUttp,
            'jenisPengajuan' => $jenisPengajuan
        ]);
    }
}
