<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\TemplateDokumen as ModelTemplateDokumen;

class TemplateDokumen extends Component
{

    use WithPagination;
    use WithFileUploads;


    public $idHapus, $edit = false, $idnya, $cari, $dokumen, $files;

    public $form = [
        'nama' => null,
        'path' => null,
    ];

    public function mount()
    {
        //
    }

    public function getEdit($a)
    {
        $this->form = ModelTemplateDokumen::find($a)->only(['nama', 'path']);
        $this->idHapus = $a;
        $this->edit = true;
    }

    public function save()
    {
        if ($this->edit) {
            $this->storeUpdate();
        } else {
            $this->store();
        }

        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
          })
        JS);
    }

    public function store()
    {
        if ($this->files) {
            $foto = $this->files->store('tera/file', 'gcs');
            $this->form['path'] = $foto;
        }

        ModelTemplateDokumen::create($this->form);
    }

    public function delete($id)
    {
        $this->idHapus = $id;
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Apakah Anda yakin?',
                text: "Apakah kamu ingin menghapus data ini? proses ini tidak dapat dikembalikan.",
                type: 'warning',
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
        ModelTemplateDokumen::destroy($this->idHapus);
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
          })
        JS);
    }

    public function storeUpdate()
    {
        if ($this->files) {
            $foto = $this->files->store('tera/file', 'gcs');
            $this->form['path'] = $foto;
        }

        ModelTemplateDokumen::find($this->idHapus)->update($this->form);
        $this->reset();
        $this->edit = false;
    }


    public function batal()
    {
        $this->edit = false;
        $this->reset();
    }

    public function render()
    {
        $data = ModelTemplateDokumen::cari($this->cari)->paginate(10);

        return view('livewire.template-dokumen', [
            'post' => $data
        ]);
    }
}
