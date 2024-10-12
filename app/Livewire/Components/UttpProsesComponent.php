<?php

namespace App\Livewire\Components;

use App\Models\Uttp;
use App\Models\ComCode;
use Livewire\Component;
use App\Models\PengajuanUttp;
use Livewire\WithFileUploads;


class UttpProsesComponent extends Component
{
    use WithFileUploads;

    public $pengajuanId, $pengajuanUttps, $files, $fileSkhp, $idnya, $bukaKeterangan = false;

    public $form = [
        'cerapan_path' => null,
        'hasil_st' => null,
        'keterangan_hasil' => null,
        'skhp_path' => null
    ];

    public function mount($id)
    {
        // Mengambil data dari tabel pengajuan_uttps beserta data dari tabel uttps
        $this->pengajuanUttps = PengajuanUttp::with(['uttp', 'hasil'])->where('pengajuan_id', $id)->get();

        $this->pengajuanId = $id;
    }

    public function Add($id)
    {
        $this->idnya = $id;
        $this->form = PengajuanUttp::find($id)->only(['hasil_st', 'keterangan_hasil', 'cerapan_path']);

        if ($this->form['hasil_st'] == 'HASIL_ST_02' || $this->form['hasil_st'] == 'HASIL_ST_03') {
            $this->bukaKeterangan = true;
        }

        $this->dispatch('showModal', id: 'modal-form');
    }

    public function save()
    {
        $this->validate([
            'files' => 'required_if:form.cerapan_path,null',
            'form.hasil_st' => 'required',
            'form.keterangan_hasil' => 'required_if:form.hasil_st,HASIL_ST_02,HASIL_ST_03|string',
        ]);

        if ($this->files) {
            $path = $this->files->store('tera/cerapan', 'gcs');
            $this->form['cerapan_path'] = $path;
        }

        if ($this->fileSkhp) {
            $path = $this->fileSkhp->store('tera/skhp', 'gcs');
            $this->form['skhp_path'] = $path;
        }

        PengajuanUttp::find($this->idnya)->update($this->form);

        $this->resetInputFields();
        $this->dispatch('hideModal', id: 'modal-form');


        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
            }).then((result) => {
                if (result.isConfirmed) {
                $wire.kembali()
                }
            });
        JS);
    }

    public function kembali()
    {
        redirect(route('permohonan-proses', $this->pengajuanId));
    }

    public function cancelForm()
    {
        $this->resetInputFields();
        $this->dispatch('hideModal', id: 'modal-form');
    }

    private function resetInputFields()
    {
        $this->files = null;
        $this->form['hasil_st'] = null;
        $this->form['keterangan_hasil'] = null;
    }

    public function updated($property)
    {
        // $property: The name of the current property that was updated

        if ($property === 'form.hasil_st') {
            if ($this->form['hasil_st'] == 'HASIL_ST_02' || $this->form['hasil_st'] == 'HASIL_ST_03') {
                $this->bukaKeterangan = true;
            } else {
                $this->bukaKeterangan = false;
                $this->form['keterangan_hasil'] = null;
            }
        }
    }

    public function render()
    {
        $hasil = ComCode::where('code_group', 'HASIL_ST')->get();

        return view('livewire.components.uttp-proses-component', [
            'hasil' => $hasil
        ]);
    }
}
