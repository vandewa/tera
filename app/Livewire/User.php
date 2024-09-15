<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Role;
use App\Models\User as ModelsUser;

class User extends Component
{

    public $role, $listRole, $konfirmasi_password, $idHapus, $edit = false, $user, $bukaNoSk = false, $bukaPangkat = false;

    public $form = [
        'name' => null,
        'email' => null,
        'nip' => null,
        'no_sk' => null,
        'pangkat' => null,
        'password' => null,
    ];


    public function mount($id = '')
    {
        if ($id) {
            $user = ModelsUser::find($id)->only(['name', 'email', 'nip']);
            $data = ModelsUser::find($id);
            $this->form = $user;
            $this->role = $data->roles()->first()->id ?? '';
            $this->edit = true;
            $this->user = $id;
            if ($this->role == '4') {
                $this->bukaNoSk = true;
            }
            if ($this->role == '5') {
                $this->bukaPangkat = true;
            }
        }

        $this->listRole = Role::all()->toArray();
    }

    public function ambilRole()
    {
        return Role::all()->toArray();

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

        return redirect(route('master.user-index'));
    }

    public function store()
    {
        $this->validate([
            'konfirmasi_password' => 'required|same:form.password',
            'form.password' => 'required',
            'form.name' => 'required',
            'form.email' => 'required|unique:users,email',
            'role' => 'required',
            'form.nip' => 'required',
        ]);

        $this->form['password'] = bcrypt($this->form['password']);
        $a = ModelsUser::create($this->form);
        $a->addrole($this->role);
    }

    public function storeUpdate()
    {
        $this->validate([
            'konfirmasi_password' => 'same:form.password',
            'form.name' => 'required',
            'form.email' => 'required|email|unique:users,email,' . $this->user,
            'role' => 'required',
            'form.nip' => 'required',
        ]);

        if ($this->form['password'] ?? "") {
            $this->form['password'] = bcrypt($this->form['password']);
        }

        ModelsUser::find($this->user)->update($this->form);
        $a = ModelsUser::find($this->user);
        $a->syncRoles([$this->role]);
        $this->reset();
        $this->edit = false;
    }

    public function updated($property)
    {
        if ($property === 'role') {
            if ($this->role == '4') {
                $this->bukaNoSk = true;
            } else {
                $this->bukaNoSk = false;
                $this->form['no_sk'] = null;
            }
        }

        if ($property === 'role') {
            if ($this->role == '5') {
                $this->bukaPangkat = true;
            } else {
                $this->bukaPangkat = false;
                $this->form['pangkat'] = null;
            }
        }
    }

    public function render()
    {
        return view('livewire.user', [
            'listRole' => $this->ambilRole()
        ]);
    }
}
