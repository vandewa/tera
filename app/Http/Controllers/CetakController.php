<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Pengajuan;
use App\Models\TemplateDokumen;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Style\Font;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function generateData(Request $request)
    {
        // Pemeriksaan::with(['pengajuan.user', 'standar', 'petugas', 'penandatangan', 'hasil'])->first();
        $data = Pemeriksaan::with([
            'pengajuan' => function ($a) {
                $a->with(['uttpItem.uttp', 'pemohon']);
            },
            'standar',
            'petugas.user',
            'berhak',
            'penandatangan',
            'hasil'
        ])->find($request->id);



        $dokumen = TemplateDokumen::where('nama', $request->jenis_download)->first();

        $lokasi = public_path('storage/' . $dokumen->path);

        $templateProcessor = new TemplateProcessor($lokasi);

        $templateVariables = $templateProcessor->getVariables();

        // utttp
        $standar = [

        ];

        $index = 1;

        foreach ($data->standar as $item) {
            array_push($standar, [
                'no_standar' => $index . ".",
                'standar' => $item->nama
            ]);
            $index = $index + 1;
        }

        $penguji = [];
        $index = 1;

        foreach ($data->petugas as $item) {
            array_push($penguji, [
                'penguji' => $index . ".",
                'penguji_nama' => $item->user->name ?? ""
            ]);
            $index = $index + 1;
        }

        $uttp = [];
        $index = 1;
        foreach ($data->pengajuan->uttpItem as $item) {

            array_push($uttp, [
                'uttp_no' => $index . ".",
                'nama' => $item->uttp->nama ?? "",
                'merek' => $item->merek ?? "",
                'tipe' => $item->tipe ?? "",
                'no_seri' => $item->no_seri ?? "",
                'kapasitas' => $item->kapasitas ?? "",
                'keterangan' => $item->keterangan ?? "",
                'jumlah' => $item->jumlah ?? "",
            ]);

            $index = $index + 1;
        }

        $tanggalDiterima = Carbon::createFromFormat('Y-m-d H:i:s', $data->pengajuan->created_at)
            ->locale('id')->isoFormat('D MMMM YYYY');

        $tanggalPemeriksaan = Carbon::createFromFormat('Y-m-d', $data->tanggal_pemeriksaan)
            ->locale('id')->isoFormat('D MMMM YYYY');

        // Tambah 1 tahun
        $tanggalPemeriksaanPlusOneYear = Carbon::createFromFormat('Y-m-d', $data->tanggal_pemeriksaan)
            ->locale('id')
            ->addYear()
            ->isoFormat('D MMMM YYYY');

        $templateProcessor->setValues([
            'nomor' => '',
            'no_order' => $data->pengajuan->order_no ?? "",
            'nama_pemilik' => $data->pengajuan->pemohon->name ?? '',
            'alamat' => $data->pengajuan->pemohon->alamat ?? '',
            'nama_perusahaan' => $data->pengajuan->pemohon->nama_usaha ?? '',
            'alamat_perusahaan' => $data->pengajuan->pemohon->alamat_perusahaan ?? '',
            'wa' => $data->pengajuan->pemohon->wa ?? '',
            'pekerjaan' => $data->pengajuan->pemohon->pekerjaan ?? '',
            'tanggaL_diterima' => $tanggalDiterima ?? '',
            'metode' => $data->metode ?? '',
            'pegawai_berhak' => $data->berhak->name ?? "",
            'telusuran' => $data->telusuran ?? '',
            'tanggal_pengujian' => $tanggalPemeriksaan ?? '',
            'hasil' => $data->hasil->code_nm ?? '',
            'tahun' => date('Y', strtotime($data->tanggal_pemeriksaan)),
            'tera_kembali' => $tanggalPemeriksaanPlusOneYear,
            'fo' => auth()->user()->name ?? '',
            'nama_ttd' => $data->penandatangan->name ?? "",
            'nip' => $data->penandatangan->nip ?? "",
            'pangkat' => $data->penandatangan->pangkat ?? "",

        ]);

        if (in_array('no_standar', $templateVariables)) {
            $templateProcessor->cloneRowAndSetValues('no_standar', $standar);
        }
        if (in_array('penguji', $templateVariables)) {
            $templateProcessor->cloneRowAndSetValues('penguji', $penguji);
        }
        if (in_array('uttp_no', $templateVariables)) {
            $templateProcessor->cloneRowAndSetValues('uttp_no', $uttp);
        }

        // $randomFileName = Str::random(10) . '.docx';

        $randomFileName = $request->jenis_download . '_' . $data->pengajuan->pemohon->name . '_' . $tanggalPemeriksaan . '.docx';

        // Define the path where the file will be temporarily saved in public/template
        $pathToSave = public_path('template/' . $randomFileName);

        // Ensure the directory exists, if not create it
        // if (!Storage::exists('generate')) {
        //     Storage::makeDirectory('generate');
        // }

        $templateProcessor->saveAs($pathToSave);
        return response()->download($pathToSave)->deleteFileAfterSend(true);

    }


    public function cetakOrder(Request $request) {
        $data = Pengajuan::with(['uttpItem.uttp', 'pemohon'])->find($request->id);



        $dokumen = TemplateDokumen::where('nama', $request->jenis_download)->first();

        $lokasi = public_path('storage/' . $dokumen->path);

        $templateProcessor = new TemplateProcessor($lokasi);

        $templateVariables = $templateProcessor->getVariables();

        // utttp
        $standar = [

        ];

        $index = 1;

        foreach ($data->standar??[] as $item) {
            array_push($standar, [
                'no_standar' => $index . ".",
                'standar' => $item->nama
            ]);
            $index = $index + 1;
        }

        $penguji = [];
        $index = 1;

        foreach ($data->petugas??[] as $item) {
            array_push($penguji, [
                'penguji' => $index . ".",
                'penguji_nama' => $item->user->name ?? ""
            ]);
            $index = $index + 1;
        }

        $uttp = [];
        $index = 1;
        foreach ($data->uttpItem as $item) {

            array_push($uttp, [
                'uttp_no' => $index . ".",
                'nama' => $item->uttp->nama ?? "",
                'merek' => $item->merek ?? "",
                'tipe' => $item->tipe ?? "",
                'no_seri' => $item->no_seri ?? "",
                'kapasitas' => $item->kapasitas ?? "",
                'keterangan' => $item->keterangan ?? "",
                'jumlah' => $item->jumlah ?? "",
            ]);

            $index = $index + 1;
        }

        $tanggalDiterima = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)
            ->locale('id')->isoFormat('D MMMM YYYY');

        $tanggalPemeriksaan ="";// Carbon::createFromFormat('Y-m-d', $data->tanggal_pemeriksaan)
           // ->locale('id')->isoFormat('D MMMM YYYY');

        // Tambah 1 tahun
        $tanggalPemeriksaanPlusOneYear = "";//Carbon::createFromFormat('Y-m-d', $data->tanggal_pemeriksaan)
            // ->locale('id')
            // ->addYear()
            // ->isoFormat('D MMMM YYYY');

        $templateProcessor->setValues([
            'nomor' => '',
            'no_order' => $data->order_no ?? "",
            'nama_pemilik' => $data->pemohon->name ?? '',
            'alamat' => $data->pemohon->alamat ?? '',
            'nama_perusahaan' => $data->pemohon->nama_usaha ?? '',
            'alamat_perusahaan' => $data->pemohon->alamat_perusahaan ?? '',
            'wa' => $data->pemohon->wa ?? '',
            'pekerjaan' => $data->pemohon->pekerjaan ?? '',
            'tanggaL_diterima' => $tanggalDiterima ?? '',
            'metode' => $data->metode ?? '',
            'pegawai_berhak' => $data->berhak->name ?? "",
            'telusuran' => $data->telusuran ?? '',
            'tanggal_pengujian' => $tanggalPemeriksaan ?? '',
            'hasil' => $data->hasil->code_nm ?? '',
            'tahun' => date('Y', strtotime($data->tanggal_pemeriksaan)),
            'tera_kembali' => $tanggalPemeriksaanPlusOneYear,
            'fo' => auth()->user()->name ?? '',
            'nama_ttd' => $data->penandatangan->name ?? "",
            'nip' => $data->penandatangan->nip ?? "",
            'pangkat' => $data->penandatangan->pangkat ?? "",

        ]);

        if (in_array('no_standar', $templateVariables)) {
            $templateProcessor->cloneRowAndSetValues('no_standar', $standar);
        }
        if (in_array('penguji', $templateVariables)) {
            $templateProcessor->cloneRowAndSetValues('penguji', $penguji);
        }
        if (in_array('uttp_no', $templateVariables)) {
            $templateProcessor->cloneRowAndSetValues('uttp_no', $uttp);
        }

        // $randomFileName = Str::random(10) . '.docx';

        $randomFileName = $request->jenis_download . '_' . $data->pemohon->name . '_' . $tanggalPemeriksaan . '.docx';

        // Define the path where the file will be temporarily saved in public/template
        $pathToSave = public_path('template/' . $randomFileName);

        // Ensure the directory exists, if not create it
        // if (!Storage::exists('generate')) {
        //     Storage::makeDirectory('generate');
        // }

        $templateProcessor->saveAs($pathToSave);
        return response()->download($pathToSave)->deleteFileAfterSend(true);
    }

}
