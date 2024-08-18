<?php

namespace App\Livewire\Components;

use App\Models\User;
use Livewire\Component;
use App\Models\Pemeriksaan;
use Livewire\WithFileUploads;
use App\Models\PemeriksaanPetugas;
use App\Models\PemeriksaanStandar;
use Illuminate\Support\Facades\Storage;

class FormProsesComponent extends Component
{
    use WithFileUploads;

    public $pemeriksaan;
    public $upload_cerapan;
    public $file_name;

    public $standars = [];
    public $petugas = [];

    public $users = [];

    protected $rules = [
        'pemeriksaan.pengajuan_id' => 'required|integer',
        'pemeriksaan.tanggal_pemeriksaan' => 'required|date',
        'pemeriksaan.hasil_keterangan' => 'nullable|string',
        'pemeriksaan.pegawai_berhak_id' => 'nullable|exists:users,id',
        'pemeriksaan.penandatanganan_id' => 'nullable|exists:users,id',
        'standars.*.user_id' => 'required|exists:users,id',
        'petugas.*.user_id' => 'required|exists:users,id',
    ];

    public function mount($id = null)
    {
        $this->users = User::all();
        $data = Pemeriksaan::where('pengajuan_id', $id)->first();
        if ($data) {
            $this->pemeriksaan = $data->toArray();
            $this->file_name = $this->pemeriksaan['upload_cerapan'] ? Storage::url($data['upload_cerapan']) : null;

            // Load related data
            $this->standars = PemeriksaanStandar::where('pemeriksaan_id', $id)->get()->toArray();
            $this->petugas = PemeriksaanPetugas::where('pemeriksaan_id', $id)->get()->toArray();
        } else {

            $a  = new Pemeriksaan;
            $a->pengajuan_id =  $id;
            $a->tanggal_pemeriksaan =  date('Y-m-d');
            $a->save();
            $this->pemeriksaan = $a;

        }
    }
    public function updatedUploadCerapan()
    {
        $this->file_name = $this->upload_cerapan->getClientOriginalName();
    }

    public function save()
    {
        $this->validate();

        if ($this->upload_cerapan) {
            $path = $this->upload_cerapan->store('cerapan');
            $this->pemeriksaan['upload_cerapan'] = $path;
        }

        // update lokasi file path cerapan

        $data = Pemeriksaan::find($this->pemeriksaan['id'])->update($this->pemeriksaan);
        // $this->pemeriksaan->save();

        // Save related data
        foreach ($this->standars as $standar) {
            PemeriksaanStandar::updateOrCreate(
                ['id' => $standar['id'] ?? null],
                ['pemeriksaan_id' => $this->pemeriksaan->id, 'user_id' => $standar['user_id']]
            );
        }

        foreach ($this->petugas as $petugas) {
            PemeriksaanPetugas::updateOrCreate(
                ['id' => $petugas['id'] ?? null],
                ['pemeriksaan_id' => $this->pemeriksaan->id, 'user_id' => $petugas['user_id']]
            );
        }

        session()->flash('message', 'Data saved successfully.');
    }

    public function addStandar()
    {
        $this->standars[] = ['user_id' => ''];
    }

    public function addPetugas()
    {

        $this->petugas[] = ['user_id' => ''];
    }

    public function removeStandar($index)
    {
        unset($this->standars[$index]);
        $this->standars = array_values($this->standars);
    }

    public function removePetugas($index)
    {
        unset($this->petugas[$index]);
        $this->petugas = array_values($this->petugas);
    }

    public function render()
    {
        return view('livewire.components.form-proses-component');
    }
}
