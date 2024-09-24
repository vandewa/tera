<?php

namespace App\Livewire;

use App\Models\ComCode;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\JadwalTera as ModelJadwalTera;

class JadwalTera extends Component
{
    use WithPagination;
    use WithFileUploads;


    public $idHapus, $edit = false, $idnya, $cari, $listJadwalTera, $uploadSuratTugas;

    public $form = [
        'lokasi' => null,
        'tanggal_mulai' => null,
        'tanggal_selesai' => null,
        'no_sk' => null,
        'jadwal_tera_st' => null,
        'surat_tugas_path' => null,
    ];

    public function mount()
    {
        $this->listJadwalTera = ComCode::where('code_group', 'JADWAL_TERA_ST')->get()->toArray();
        $this->form['tanggal_mulai'] = date('Y-m-d');
        $this->form['tanggal_selesai'] = date('Y-m-d');
    }

    public function ambilJadwalTera()
    {
        return ComCode::where('code_group', 'JADWAL_TERA_ST')->get()->toArray();
    }

    public function getEdit($id)
    {
        $this->form = ModelJadwalTera::find($id)->only(['lokasi', 'tanggal_mulai', 'tanggal_selesai', 'no_sk', 'jadwal_tera_st']);
        $this->idHapus = $id;
        $this->edit = true;
    }

    public function save()
    {
        $this->validate([
            'form.lokasi' => 'required|string|max:255',
            'form.tanggal_mulai' => 'required|date',
            'form.tanggal_selesai' => 'required|date|after_or_equal:form.tanggal_mulai',
            // 'form.jadwal_tera_st' => 'required|string|max:255',
        ]);

        if ($this->edit) {
            $this->storeUpdate();
        } else {
            $this->store();
        }

        $this->showSuccessMessage('Data has been saved successfully!');
    }

    public function store()
    {
        if ($this->uploadSuratTugas) {
            $path = $this->uploadSuratTugas->store('tera/surat-tugas', 'gcs');
            $this->form['surat_tugas_path'] = $path;
        }

        ModelJadwalTera::create($this->form);

        $this->resetForm();
    }

    public function delete($id)
    {
        $this->idHapus = $id;
        $this->js(<<<'JS'
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Apakah kamu ingin menghapus data ini? proses ini tidak dapat dikembalikan.",
            icon: 'warning',
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
        ModelJadwalTera::destroy($this->idHapus);
        $this->showSuccessMessage('Data has been deleted successfully!');
    }

    public function storeUpdate()
    {
        if ($this->uploadSuratTugas) {
            $path = $this->uploadSuratTugas->store('tera/surat-tugas', 'gcs');
            $this->form['surat_tugas_path'] = $path;
        }

        ModelJadwalTera::find($this->idHapus)->update($this->form);
        $this->resetForm();
    }

    public function batal()
    {
        $this->edit = false;
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->reset('form');
        $this->uploadSuratTugas = null;
        $this->edit = false;
    }

    private function showSuccessMessage($message)
    {
        $this->js(<<<JS
        Swal.fire({
            title: 'Good job!',
            text: '$message',
            icon: 'success',
        })
        JS);
    }

    public function render()
    {
        $data = ModelJadwalTera::cari($this->cari)->orderBy('tanggal_mulai', 'asc')->paginate(10);

        return view('livewire.jadwal-tera', [
            'post' => $data,
            'listJadwalTera' => $this->ambilJadwalTera()
        ]);
    }
}
