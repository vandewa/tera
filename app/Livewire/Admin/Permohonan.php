<?php

namespace App\Livewire\Admin;

use App\Models\Pengajuan;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Uttp as ModelUttp;

class Permohonan extends Component
{
    use WithPagination;

    public $idHapus, $edit = false, $idnya, $cari, $jenis;

    public $form = [
        'nama' => null,
    ];

    public function mount($id = '')
    {
        $this->idnya = $id;

        if ($this->idnya == 1) {
            $this->jenis = 'PENGAJUAN_TP_01';
        } else {
            $this->jenis = 'PENGAJUAN_TP_02';
        }

    }

    public function getEdit($a)
    {
        $this->form = ModelUttp::find($a)->only(['nama']);
        $this->idHapus = $a;
        $this->edit = true;
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
    }

    public function store()
    {
        ModelUttp::create($this->form);
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
        Pengajuan::destroy($this->idHapus);
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
        ModelUttp::find($this->idHapus)->update($this->form);
        $this->reset();
        $this->edit = false;
    }


    public function batal()
    {
        $this->edit = false;
        $this->reset();
    }

    public function render()
    {
        $data = Pengajuan::with(['jenisPengajuan', 'statusPengajuan', 'uttpItem.uttp'])
        ->where('jadwal_tera_id', null)
        ->where('pengajuan_tp', $this->jenis);

            if(auth()->user()->hasRole(['penera'])){
            $data->whereHas('pemeriksaan', function($a){
                $a->whereHas('petugas', function($b){
                    $b->where('user_id', auth()->user()->id);
                });
            });
            }

        $hasil = $data->orderby('created_at', 'desc')->paginate(10);
        return view('livewire.admin.permohonan', [
            'post' => $hasil,
        ]);
    }
}
