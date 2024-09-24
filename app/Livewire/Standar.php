<?php

namespace App\Livewire;

use App\Models\Standar as ModelsStandar;
use Livewire\Component;
use Livewire\WithPagination;

class Standar extends Component
{
    use WithPagination;

    public $idHapus, $edit = false, $idnya, $cari, $listPeralatan;

    public $form = [
        'nama' => null,
    ];

    public function mount()
    {
        //
    }

    public function getEdit($id)
    {
        $this->form = ModelsStandar::find($id)->only(['nid: ama']);
        $this->idHapus = $id;
        $this->edit = true;
    }

    public function save()
    {
        $this->validate([
            'form.nama' => 'required',
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
        ModelsStandar::create($this->form);
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
        ModelsStandar::destroy($this->idHapus);
        $this->showSuccessMessage('Data has been deleted successfully!');
    }

    public function storeUpdate()
    {
        ModelsStandar::find($this->idHapus)->update($this->form);
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
        $data = ModelsStandar::cari($this->cari)->paginate(10);

        return view('livewire.standar', [
            'post' => $data,
        ]);
    }


}
