<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\Pengajuan;

class RekapPelayananExport implements FromView
{
    public $tahun;

    public function __construct($tahun)
    {
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        // Query data pengajuan dengan relasi UTTP items
        $data = Pengajuan::with([
            'uttpItem.uttp',
            'user',
            'statusPengajuan',
            'jenisPengajuan'
        ])
        ->whereYear('created_at', $this->tahun)
        ->orderBy('created_at', 'asc')
        ->get();

        return view('laporan.rekap-pelayanan', [
            'data' => $data,
            'tahun' => $this->tahun
        ]);
    }
}
