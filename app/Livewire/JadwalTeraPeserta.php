<?php

namespace App\Livewire;

use App\Models\Uttp;
use Illuminate\Support\Js;
use Livewire\Component;
use Livewire\Attributes\Computed;
use App\Models\PesertaSidang;
use App\Models\PesertaSidangUttp;

class JadwalTeraPeserta extends Component
{
    public $idnya;
    public $listUttp = [];
    public $uttpPeserta = [];
    public $idEdit = null;
    public $idHapus = null;
    public $form = [
        'nama' => null,
        'telepon' => null
    ];
    public $uttp = [
        'uttp_id' => null,
        'jumlah' => null,
    ];


    #[Computed]
    public function dataUttpPeserta()
    {
        return $this->uttpPeserta;
    }



    public function namaUttp($id)
    {
        return Uttp::find($id);
    }

    public function mount($id = "")
    {
        $this->idnya = $id;
        $this->listUttp = Uttp::all();
    }

    public function tambahUttp()
    {
        // Validasi input
        try {
            $this->validate([
                'uttp.uttp_id' => 'required',
                'uttp.jumlah' => 'required|numeric|min:1',
            ]);

            // If validation passes, continue with the logic
            // Example: Save to database or perform action
        } catch (\Illuminate\Validation\ValidationException $e) {
            // If validation fails, you can return a specific response or action
            $this->js(<<<JS
                 Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "Harap isi semua data",
            });
            JS);

            return;
        }

        // Ambil semua uttp_id dari array uttpPeserta
        $uttpIds = array_column($this->uttpPeserta, 'uttp_id');

        // Cek apakah uttp_id sudah ada di dalam array
        if (in_array($this->uttp['uttp_id'], $uttpIds)) {
            // Jika ada, tambahkan jumlah pada uttp_id yang sesuai
            foreach ($this->uttpPeserta as &$item) {
                if ($item['uttp_id'] == $this->uttp['uttp_id']) {
                    $item['jumlah'] += $this->uttp['jumlah'];
                    break; // Stop looping karena sudah ditemukan
                }
            }
        } else {
            // Jika tidak ada, tambahkan data baru ke uttpPeserta
            array_push($this->uttpPeserta, (array) $this->uttp);
        }

        $this->uttp = [
            'uttp_id' => null,
            'jumlah' => null
        ];
    }

    public function simpan()
    {
        $this->validate([
            'form.nama' => 'required',
            'form.telepon' => 'required'
        ]);

        if (!count($this->uttpPeserta)) {
            $this->js(<<<JS
                Swal.fire({
                icon: 'error',
            title: 'Oops...',
            text: "setidaknya harus terdapat 1 Uttp",
                });
            JS);

            return;
        }
        if (!$this->idEdit) {
            $data = PesertaSidang::create($this->form + ['jadwal_tera_id' => $this->idnya]);
            foreach ($this->uttpPeserta as $item) {
                $data->uttpPesertaSidang()->create($item);
            }
        } else {
            PesertaSidang::where('id', $this->idEdit)->update($this->form);
            PesertaSidangUttp::where('peserta_sidang_id', $this->idEdit)->delete();
            foreach ($this->uttpPeserta as $item) {
                PesertaSidangUttp::create($item + ['peserta_sidang_id' => $this->idEdit]);
            }

        }


        $this->bersihkan();

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
        PesertaSidang::destroy($this->idHapus);
        $this->idHapus =  null;
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Good job!',
            text: 'You clicked the button!',
            icon: 'success',
          })
        JS);
    }

    public function bersihkan()
    {
        $this->uttpPeserta = [];
        $this->form = [
            'nama' => null,
            'telepon' => null
        ];
        // $this->idnya =  null;
    }

    public function hapusTemporartyUttp($id)
    {

        unset($this->uttpPeserta[$id]);
    }

    public function edit($id)
    {
        $this->bersihkan();
        $this->idEdit = $id;
        $data = PesertaSidang::with(['uttpPesertaSidang'])->find($id);
        $this->form['nama'] = $data->nama;
        $this->form['telepon'] = $data->telepon;
        foreach ($data->uttpPesertaSidang ?? [] as $item) {
            array_push($this->uttpPeserta, ['uttp_id' => $item->uttp_id, 'jumlah' => $item->jumlah]);
        }
    }

    public function render()
    {
        $data = PesertaSidang::with(['uttpPesertaSidang.uttp'])->where('jadwal_tera_id', $this->idnya)
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        return view('livewire.jadwal-tera-peserta', [
            'data' => $data
        ]);
    }
}
