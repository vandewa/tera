<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\Models\JadwalTera;
use Illuminate\Support\Facades\DB;

class RekapSidangTeraUlangExport implements FromView
{
    public $tahun;

    public function __construct($tahun)
    {
        $this->tahun = $tahun;
    }

    public function view(): View
    {
        // Query untuk rekap per sidang tera
        $data = JadwalTera::with(['status'])
            ->whereYear('tanggal_mulai', $this->tahun)
            ->orderBy('tanggal_mulai', 'asc')
            ->get()
            ->map(function ($jadwal, $index) {
                // Hitung jumlah per jenis UTTP untuk sidang ini
                $uttpCounts = DB::table('peserta_sidangs')
                    ->join('peserta_sidang_uttps', 'peserta_sidangs.id', '=', 'peserta_sidang_uttps.peserta_sidang_id')
                    ->join('uttps', 'peserta_sidang_uttps.uttp_id', '=', 'uttps.id')
                    ->where('peserta_sidangs.jadwal_tera_id', $jadwal->id)
                    ->select('uttps.nama', DB::raw('SUM(peserta_sidang_uttps.jumlah) as total'))
                    ->groupBy('uttps.nama')
                    ->get()
                    ->keyBy('nama');

                // Hitung total keseluruhan
                $totalKeseluruhan = $uttpCounts->sum('total');

                return [
                    'no' => $index + 1,
                    'tanggal_mulai' => $jadwal->tanggal_mulai,
                    'tanggal_selesai' => $jadwal->tanggal_selesai,
                    'lokasi' => $jadwal->lokasi,
                    'uttpCounts' => $uttpCounts,
                    'total' => $totalKeseluruhan,
                    'jadwal' => $jadwal
                ];
            });

        return view('laporan.rekap-sidang-tera-ulang', [
            'data' => $data,
            'tahun' => $this->tahun
        ]);
    }
}
