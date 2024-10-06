<?php

namespace App\Http\Controllers;

use App\Models\Uttp;
use Illuminate\Http\Request;
use App\Exports\RekapPertanggalExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function rekap()
    {
        return view('rekap');
    }

    public function storeTriwulan(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $data = Uttp::withCount([
            'pengajuan' => function ($a) use ($request) {
                $a->whereHas('pengajuannya', function ($a) {
                    $a->where('pengajuan_st', 'PENGAJUAN_ST_05');
                });
                $a->whereBetween('created_at', [$request->start_date, $request->end_date . ' 23:59:59']);
            }
        ])->get();

        $totalPengajuanCount = $data->sum('pengajuan_count');

        return view('laporan.rekap-pertanggal', compact('data', 'totalPengajuanCount'));

    }

    public function storeGlobal(Request $request)
    {
        // Initialize an array to store the results per month
        $monthlyData = [];

        // Loop through each month to get the data
        for ($month = 1; $month <= 12; $month++) {
            $monthlyData[$month] = Uttp::withCount([
                'pengajuan' => function ($query) use ($month, $request) {
                    $query->whereHas('pengajuannya', function ($query) {
                        $query->where('pengajuan_st', 'PENGAJUAN_ST_05');
                    });
                    // Get the data for the specified year and month
                    $query->whereYear('created_at', $request->tahun)
                        ->whereMonth('created_at', $month);
                }
            ])->get();
        }

        // Calculate total counts for each month and overall total
        $monthlyCounts = [];
        $totalPengajuanCount = 0;

        foreach ($monthlyData as $month => $data) {
            $monthlyCounts[$month] = $data->sum('pengajuan_count');
            $totalPengajuanCount += $monthlyCounts[$month];
        }

        // Pass the data to the view
        return view('laporan.global', compact('monthlyData', 'monthlyCounts', 'totalPengajuanCount'));
    }

    public function rekapSidang(Request $request) {
        // Ambil semua nama UTTP yang ada di tabel uttps
        $uttpNames = DB::table('uttps')
                        ->select('nama')
                        ->distinct()
                        ->orderBy('nama', 'asc')
                        ->pluck('nama')
                        ->toArray();

        // Buat kolom-kolom dinamis berdasarkan nama UTTP
        $columns = [];
        foreach ($uttpNames as $name) {
            $columns[] = "MAX(CASE WHEN u.nama = '$name' THEN psu.jumlah ELSE 0 END) AS `$name`";
        }
        $columnList = implode(', ', $columns);

        // Bangun query dinamis untuk crosstab
        $query = "
            SELECT jt.id, ps.nama AS peserta, $columnList
            FROM jadwal_teras jt
            JOIN peserta_sidangs ps ON jt.id = ps.jadwal_tera_id
            JOIN peserta_sidang_uttps psu ON psu.peserta_sidang_id = ps.id
            JOIN uttps u ON u.id = psu.uttp_id
            where jt.id = ".$request->id."
            GROUP BY jt.id, ps.nama
            ORDER BY jt.id, ps.nama;
        ";
// dd($query);
            // Eksekusi query menggunakan raw SQL
            $results = DB::select($query);

// Kirim hasil dan nama-nama kolom ke view untuk ditampilkan
        return view('laporan.rekap-sidang', compact('results', 'uttpNames'));
    }

    // public function rekapPertanggal(Request $request)
    // {
    //     $data = Uttp::where('created_at', '>=', $request->start_date)->get();

    //     return view('laporan.rekap-pertanggal', compact('data'));

    //     // return Excel::download(new RekapPertanggalExport($request), 'namafiledownload.xlsx');

    // }
}
