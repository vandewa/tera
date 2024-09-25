<?php

namespace App\Livewire\Permohonan;

use App\Models\ComCode;
use App\Models\Pemohon;
use Livewire\Component;
use App\Models\UttpUser;
use App\Models\Pengajuan;
use Illuminate\Support\Arr;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Uttp as ModelUttp;

class PermohonanFormPage extends Component
{
    use WithPagination;
    use WithFileUploads;


    public $idHapus, $edit = false, $idnya, $cari, $bukaAlamat, $files;
    public $showModal = true;
    public $listUttp;
    public $selectedUttp = [];

    public $form = [
        'pengajuan_tp' => null,
        'alamat' => null,
        'tanggal' => null,
        'surat_permohonan_path' => null,
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

        $this->listUttp = UttpUser::with(['uttp'])
            ->where('user_id', auth()->user()->id)
            ->get()
            ->toArray();

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

                foreach ($this->formUttp as $index => $datum) {
                    $this->selectedUttp[$index] = $datum['uttp_user_id'];

                }

                // Form alamat
                $this->bukaAlamat = $this->form['pengajuan_tp'] === 'PENGAJUAN_TP_02';

            }

            $this->edit = true;

        }
    }

    public function hapusUttp($index)
    {
        // dd($this->formUttp[$index]['uttp_user_id']);
        $filteredArray = array_filter($this->selectedUttp, function ($value) use ($index) {
            return $value != $this->formUttp[$index]['uttp_user_id'];
        }, ARRAY_FILTER_USE_BOTH);

        $this->selectedUttp = $filteredArray;
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
            'files' => 'required_if:form.pengajuan_tp,PENGAJUAN_TP_02',
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
        if ($this->files) {
            $path = $this->files->store('tera/surat-permohonan', 'gcs');
            $this->form['surat_permohonan_path'] = $path;
        }

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

        if ($this->files) {
            $path = $this->files->store('tera/surat-permohonan', 'gcs');
            $this->form['surat_permohonan_path'] = $path;
        }

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
        $this->showModal = !$this->showModal;
    }

    public function tambahPengajuan()
    {
        $this->tambahUttp();
        $numericArray = array_map('intval', array_values($this->selectedUttp));
        $datanya = UttpUser::with(['uttp'])->whereIn('id', $numericArray)->get();

        foreach ($datanya as $datum) {
            $data = [
                'uttp_user_id' => $datum->id,
                'uttp_id' => $datum->uttp_id,
                'no_seri' => $datum->no_seri,
                'tipe' => $datum->tipe,
                'merek' => $datum->merek,
                'kapasitas' => $datum->kapasitas,
                'jumlah' => $datum->jumlah,
                'keterangan' => $datum->keterangan,
            ];
            $exists = collect($this->formUttp)->contains('uttp_user_id', $datum->id);

            if (!$exists) {
                array_push($this->formUttp, $data);
            }
        }



        // dd( Arr::flatten($this->selectedUttp));
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
