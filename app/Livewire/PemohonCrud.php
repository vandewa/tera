<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pemohon;
use App\Models\User;

class PemohonCrud extends Component
{
    use WithPagination;

    public $pemohonId, $userId, $nama, $nik, $alamat, $telepon, $email;
    public $isOpen = false;

    public function render()
    {
        return view('livewire.pemohon-crud', [
            'pemohons' => Pemohon::paginate(10),
            'users' => User::all() // Fetch all users for selection
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function edit($id)
    {
        $pemohon = Pemohon::find($id);
        $this->pemohonId = $pemohon->id;
        $this->userId = $pemohon->user_id;
        $this->nama = $pemohon->nama;
        $this->nik = $pemohon->nik;
        $this->alamat = $pemohon->alamat;
        $this->telepon = $pemohon->telepon;
        $this->email = $pemohon->email;
        $this->isOpen = true;
    }

    public function save()
    {
        $this->validate([
            'userId' => 'nullable|exists:users,id',
            'nama' => 'required|string',
            'nik' => 'required|string',
            'alamat' => 'nullable|string',
            'telepon' => 'nullable|string',
            'email' => 'nullable|email'
        ]);

        Pemohon::updateOrCreate(
            ['id' => $this->pemohonId],
            [
                'user_id' => $this->userId,
                'nama' => $this->nama,
                'nik' => $this->nik,
                'alamat' => $this->alamat,
                'telepon' => $this->telepon,
                'email' => $this->email
            ]
        );

        session()->flash('message', $this->pemohonId ? 'Pemohon updated successfully.' : 'Pemohon created successfully.');

        $this->closeModal();
    }

    public function delete($id)
    {
        Pemohon::find($id)->delete();
        session()->flash('message', 'Pemohon deleted successfully.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->pemohonId = null;
        $this->userId = null;
        $this->nama = '';
        $this->nik = '';
        $this->alamat = '';
        $this->telepon = '';
        $this->email = '';
    }
}
