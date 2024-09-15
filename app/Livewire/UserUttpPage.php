<?php

namespace App\Livewire;

use App\Models\ComCode;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Uttp;
use App\Models\UttpUser;

class UserUttpPage extends Component
{
    use WithPagination;

    public $idHapus, $edit = false, $idnya, $cari, $listUttp;

    public $form = [
        'uttp_id' => null,
        'no_seri' => null,
        'merek' => null,
        'tipe' => null,
        'kapasitas' => null,
        'jumlah' => null,
        'keterangan' => null,

    ];

    public function mount()
    {
        $this->listUttp = Uttp::get()->toArray();
    }



    public function getEdit($id)
    {
        $this->form = UttpUser::find($id)->toArray();
        $this->idHapus = $id;
        $this->edit = true;
    }

    public function save()
    {
        $this->validate([
            'form.uttp_id' => 'required|string|max:255',
            'form.no_seri' => 'required|integer',
            'form.merek' => 'max:255',
            'form.tipe' => 'string|max:255',
            'form.jumlah' => 'required|number|max:255',
            'form.keterangan' => 'string|max:255',
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
        UttpUser::create($this->form);
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
        UttpUser::destroy($this->idHapus);
        $this->showSuccessMessage('Data has been deleted successfully!');
    }

    public function storeUpdate()
    {
        UttpUser::find($this->idHapus)->update($this->form);
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
        $data = UttpUser::with(['status'])->cari($this->cari)
        ->where('user_id', auth()->user()->id)->paginate(10);

        return view('livewire.user-uttp-page', [
            'post' => $data,

        ]);
    }


}
