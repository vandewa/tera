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
        'pekerjaan' => null,
        'alamat' => null,
        'email' => null,
        'password' => null,
    ];

    public function mount()
    {
        $this->form['password'] = Str::random(8);
    }

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


        $this->form['password'] = bcrypt($this->form['password']);
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
