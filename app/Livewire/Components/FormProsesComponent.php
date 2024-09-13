<?php

namespace App\Livewire\Components;


use App\Models\ComCode;
use App\Models\User;
use Livewire\Component;
use App\Models\Pemeriksaan;
use Livewire\WithFileUploads;
use App\Models\PemeriksaanPetugas;
use App\Models\PemeriksaanStandar;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Storage;
use Auth;

class FormProsesComponent extends Component
{
    use WithFileUploads;

    public $pemeriksaan;
    public $upload_cerapan;
    public $file_name;
    public $tampilAlasn = false;
    public $hapusStandar = [];
    public $hapusPetugas = [];
    public $idnya;

    public $standars = [];
    public $hasil = [];
    public $petugas = [];

    public $users = [];

    public $penandatangan;



    public function updated($property)
    {
        // $property: The name of the current property that was updated

        if ($property === 'pemeriksaan.hasil_st') {
            if ($this->pemeriksaan['hasil_st'] == 'HASIL_ST_02' || $this->pemeriksaan['hasil_st'] == 'HASIL_ST_03') {
                $this->tampilAlasn = true;
            } else {
                $this->tampilAlasn = false;
                $this->pemeriksaan['hasil_keterangan'] = null;
            }
        }
    }

    public function mount($id = null)
    {
        $this->idnya = $id;
        // $this->users = User::whereDoesntHave('roles', function ($query) {
        //     $query->where('name', 'user');
        // })->get();

        $this->users = User::whereHasRole(['penera', 'administrator', 'superadministrator'])->get();
        $this->penandatangan = User::whereHasRole('kepala_dinas')->get();

        $this->standars = PemeriksaanStandar::where('pemeriksaan_id', $id)->get()->toArray();
        $this->petugas = PemeriksaanPetugas::where('pemeriksaan_id', $id)->get()->toArray();
        $this->hasil = ComCode::where('code_group', 'HASIL_ST')->get();
        $data = Pemeriksaan::where('pengajuan_id', $id)->first();
        if ($data) {
            $this->pemeriksaan = $data->toArray();
            $this->file_name = $this->pemeriksaan['upload_cerapan'] ? Storage::url($data['upload_cerapan']) : null;

            // Load related data

        } else {

            $a = new Pemeriksaan;
            $a->pengajuan_id = $id;
            $a->tanggal_pemeriksaan = date('Y-m-d');
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
        // dd($this->pemeriksaan);
        $this->validate([
            'pemeriksaan.pengajuan_id' => 'required|integer',
            'pemeriksaan.tanggal_pemeriksaan' => 'required|date',
            'pemeriksaan.metode' => 'required',
            'pemeriksaan.telusuran' => 'required',
            'pemeriksaan.hasil_st' => 'required',
            'pemeriksaan.hasil_keterangan' => 'required_if:pemeriksaan.hasil_st,HASIL_ST_02|string|nullable',
            'pemeriksaan.pegawai_berhak_id' => 'nullable|exists:users,id',
            'pemeriksaan.penandatanganan_id' => 'nullable|exists:users,id',
            'petugas.*.user_id' => 'required'
        ]);

        if ($this->upload_cerapan) {
            $path = $this->upload_cerapan->store('tera/file', 'gcs');
            $this->pemeriksaan['upload_cerapan'] = $path;
        }

        // update lokasi file path cerapan
        $this->pemeriksaan['status_st'] = 'PENGAJUAN_ST_03';
        Pemeriksaan::find($this->pemeriksaan['id'])->update([
            'metode' => $this->pemeriksaan['metode'],
            'telusuran' => $this->pemeriksaan['telusuran'],
            'hasil_st' => $this->pemeriksaan['hasil_st'],
            'hasil_keterangan' => $this->pemeriksaan['hasil_keterangan'],
            'pegawai_berhak_id' => $this->pemeriksaan['pegawai_berhak_id'],
            'penandatanganan_id' => $this->pemeriksaan['penandatanganan_id'],
        ]);

        if ($this->upload_cerapan) {
            Pemeriksaan::find($this->pemeriksaan['id'])->update(['upload_cerapan' => $this->pemeriksaan['upload_cerapan']]);
        }

        // $this->pemeriksaan->save();

        // Save related data
        foreach ($this->standars as $standar) {
            PemeriksaanStandar::updateOrCreate(
                ['id' => $standar['id'] ?? null],
                [
                    'pemeriksaan_id' => $this->pemeriksaan['id'],
                    'user_id' => Auth::id(),
                    'nama' => $standar['nama']
                ]
            );
        }

        foreach ($this->petugas as $petugas) {
            PemeriksaanPetugas::updateOrCreate(
                ['id' => $petugas['id'] ?? null],
                ['pemeriksaan_id' => $this->pemeriksaan['id'], 'user_id' => $petugas['user_id']]
            );
        }
        PemeriksaanStandar::whereIn('id', $this->hapusStandar)->delete();
        PemeriksaanPetugas::whereIn('id', $this->hapusPetugas)->delete();
        Pengajuan::find($this->idnya)->update([
            'pengajuan_st' => 'PENGAJUAN_ST_04'
        ]);
        $this->dispatch('restart');
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
        if ($this->standars[$index]['id'] ?? null) {
            array_push($this->hapusStandar, $this->standars[$index]['id']);
        }

        unset($this->standars[$index]);
        $this->standars = array_values($this->standars);
    }

    public function removePetugas($index)
    {
        if ($this->petugas[$index]['id'] ?? null) {
            array_push($this->hapusPetugas, $this->petugas[$index]['id']);
        }
        unset($this->petugas[$index]);
        $this->petugas = array_values($this->petugas);
    }

    public function render()
    {
        return view('livewire.components.form-proses-component');
    }
}
