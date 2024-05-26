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
    ];

    public $formUttp = [

    ];

    public function updated($property)
    {
        // $property: The name of the current property that was updated

        if ($property === 'form.pengajuan_tp') {
            if($this->form['pengajuan_tp'] === "PENGAJUAN_TP_02"){
                $this->bukaAlamat = true;
            } else {
                $this->bukaAlamat = false;
                $this->form['alamat'] =  null;
            }
        }
    }

    public function mount()
    {
        if(count($this->formUttp) < 1){
            $this->tambahUttp();
        }
    }

    public function hapusUttp($index) {
        unset($this->formUttp[$index]);
    }

    public function save() {
        $this->validate([
            'formUttp.*.uttp_id' => 'required',
            'formUttp.*.jumlah' => 'required',
            'form.pengajuan_tp' => 'required',
            'form.alamat' => 'required_if:form.pengajuan_tp,PENGAJUAN_TP_02',
        ]);

        $a = Pengajuan::create([
            'user_id' => auth()->user()->id,
            'order_no' => genNo(),
            'pengajuan_st' => 'PENGAJUAN_ST_01',
        ]+ $this->form);

        foreach($this->formUttp as $item){
            $a->uttpItem()->create($item);
        }


        $this->redirect(PermohonanPage::class);
        $this->js(<<<JS
            Swal.fire({
            title: "Berhasil!",
            text: "Anda berhasil meengajuak tera!",
            icon: "success"
            });
        JS);
    }

    public function tambahUttp() {
        $data = [
            'uttp_id' => null,
            'no_seri' => null,
            'merek' => null,
            'tipe' => null,
            'kapasitas' => null,
            'jumlah' =>null,
        ];
        array_push($this->formUttp, $data);
    }


    public function render()
    {
        $data = ModelUttp::all();
        $jenisPengajuan = ComCode::where('code_group','PENGAJUAN_TP')->get();
        return view('livewire.permohonan.permohonan-form-page', [
            'uttp' => $data,
            'uttpForm' => $this->formUttp,
            'jenisPengajuan' => $jenisPengajuan
        ]);
    }
}
