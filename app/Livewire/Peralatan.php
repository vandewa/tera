<?php

namespace App\Livewire;

use App\Models\ComCode;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Peralatan as ModelPeralatan;

class Peralatan extends Component
{
    use WithPagination;

    public $idHapus, $edit = false, $idnya, $cari, $listPeralatan;

    public $form = [
        'nama' => null,
        'satuan_id' => null,
        'no_seri' => null,
        'peralatan_st' => null,
    ];

    public function mount()
    {
        $this->listPeralatan = ComCode::where('code_group', 'PERALATAN_ST')->get()->toArray();
    }

    public function ambilPeralatan()
    {
        return ComCode::where('code_group', 'PERALATAN_ST')->get()->toArray();
    }

    public function getEdit($id)
    {
        $this->form = ModelPeralatan::find($id)->only(['nama', 'satuan_id', 'no_seri', 'peralatan_st']);
        $this->idHapus = $id;
        $this->edit = true;
    }

    public function save()
    {
        $this->validate([
            'form.nama' => 'required|string|max:255',
            'form.satuan_id' => 'required|integer',
            'form.no_seri' => 'required|string|max:255',
            'form.peralatan_st' => 'required|string|max:255',
        ]);

        if ($this->edit) {
            $this->storeUpdate();
        } else {
            $this->store();
        }

        $this->showSuccessMessage('You clicked the button!');
    }

    public function store()
    {
        ModelPeralatan::create($this->form);
        $this->resetForm();
    }

    public function delete($id)
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
                $wire.hapus()
            }
        })
        JS);
    }

    public function hapus()
    {
        ModelPeralatan::destroy($this->idHapus);
        $this->showSuccessMessage('Data has been deleted successfully!');
    }

    public function storeUpdate()
    {
        ModelPeralatan::find($this->idHapus)->update($this->form);
        $this->resetForm();
    }

    public function batal()
    {
        $this->edit = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset('form');
        $this->edit = false;
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

    public function render()
    {
        $data = ModelPeralatan::with(['status'])->cari($this->cari)->paginate(10);

        return view('livewire.peralatan', [
            'post' => $data,
            'listPeralatan' => $this->ambilPeralatan()
        ]);
    }


}
