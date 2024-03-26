<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\User as ModelsUser;

class DataDiri extends Component
{
    public $id;

    #[Validate]
    public $form = [
        'name' => null,
        'email' => null,
        'nik' => null,
        'wa' => null,
        'nama_usaha' => null,
        'alamat' => null,
        // 'password' => null,
    ];

    public function mount()
    {
        $this->id = auth()->user()->id;
        $data = ModelsUser::find($this->id)->only(['name', 'email', 'nik', 'wa', 'nama_usaha', 'alamat']);
        $this->form = $data;
    }

    public function rules()
    {
        return [
            'form.name' => 'required',
            'form.email' => 'required',
            'form.nik' => 'required',
            'form.wa' => 'required',
            'form.nama_usaha' => 'required',
            'form.alamat' => 'required',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $this->storeUpdate();

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
        ModelsUser::find($this->id)->update($this->form);
    }

    public function render()
    {
        return view('livewire.data-diri');
    }
}
