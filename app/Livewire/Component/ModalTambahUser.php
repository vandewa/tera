<?php

namespace App\Livewire\Component;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class ModalTambahUser extends Component
{

    use WithPagination;
    public $search;
    public $modalnya = false;

    public $form = [
        'name' => null,
        'nik' => null,
        'wa' => null,
        'email' => null,
        'password' => null,
    ];

    // public function pilih($id)
    // {
    //     $this->dispatch('pilih-user', $id);
    //     $this->showModalnya();
    // }

    #[On('show-modal-tambah-user')]
    public function showModalnya()
    {
        $this->modalnya = !$this->modalnya;
        $this->dispatch('autofocus', id: 'search-user');
    }

    public function save()
    {
        $this->validate([
            'form.name' => 'required',
            'form.email' => 'required|unique:users,email',
            'form.nik' => 'required|unique:users,email',
        ]);

        $password = Str::random(8);
        $this->form['password'] = Hash::make($password);
        $a = User::create($this->form);
        $a->addrole('3');

        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
          })
        JS);

        $this->reset('form');
        $this->modalnya = false;

    }

    public function render()
    {
        return view('livewire.component.modal-tambah-user');
    }
}
