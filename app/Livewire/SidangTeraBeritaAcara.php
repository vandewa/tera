<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BeritaAcara;
use Illuminate\Support\Facades\DB;

class SidangTeraBeritaAcara extends Component
{
    public $idnya;
    public $form = [
        'sah' => null,
        'tidak_sah' => null
    ];
    public function mount($id = "")  {
        $this->idnya = 1;
        $this->ambilData();
    }

    public function ambilData() {
     $data =   BeritaAcara::firstOrCreate([
            'jadwal_tera_id' => $this->idnya
        ]);

        $this->form['sah'] = $data->sah;
        $this->form['tidak_sah'] = $data->tidak_sah;

    }

    public function simpan() {
        BeritaAcara::where('jadwal_tera_id', $this->idnya)->update($this->form);
        session()->flash('status', 'Data berhasil di simpan');

    }
    public function render()
    {
        $results = DB::table('peserta_sidang_uttps as psu')
        ->join('peserta_sidangs as ps', 'ps.id', '=', 'psu.peserta_sidang_id')
        ->join('uttps as u', 'psu.uttp_id', '=', 'u.id')
        ->select('ps.jadwal_tera_id', 'u.nama', DB::raw('SUM(psu.jumlah) as jumlah'))
        ->where('ps.jadwal_tera_id', $this->idnya)
        ->groupBy('ps.jadwal_tera_id', 'u.nama')
        ->get();

        return view('livewire.sidang-tera-berita-acara', [
            'results' => $results
        ]);
    }
}
