<?php

namespace App\Livewire\Component;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ModalUser extends Component
{

    use WithPagination;
    public $search;
    public $modal = false;

    public function pilih($id)
    {
        $this->dispatch('pilih-user', $id);
        $this->showModal();
    }

    #[On('show-modal-user')]
    public function showModal()
    {
        $this->modal = !$this->modal;
        $this->search = null;
        $this->dispatch('autofocus', id: 'search-user');
    }
    public function render()
    {
        $data = User::whereHasRole('user')->cari($this->search)->paginate(7);

        return view('livewire.component.modal-user', [
            'posts' => $data
        ]);
    }
}
