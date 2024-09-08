<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Pengajuan;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Style\Font;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function generateData(Request $request)
    {
        $data = Pemeriksaan::with(['pengajuan' => function($a){
            $a->with(['uttpItem', 'pemohon']);
        }, 'standar', 'petugas', 'berhak', 'penandatangan'])->first();
        $lokasi = storage_path('app/aa.docx');
        $templateProcessor = new TemplateProcessor($lokasi);

        $templateVariables = $templateProcessor->getVariables();

        // utttp
        $standar = [
            ['standar' => 'Anak Timbangan Kelas F2 '],

        ];
        $pennguji = [
            ['penguji' => 'devan '],

        ];
        $templateProcessor->setValues([
            'nomor' => 'John',
            'no_order' => 'John',
            'nama_pemilik' => 'Doe',
            'alamat' => 'Doe',
            'tanggaL_diterima' => 'Doe',
            'metode' => 'Doe',
            'pegawai_berhak' => 'Doe',
            'telusuran' => '',
            'tanggal_pengujian' => '',
            'lokasi_pengujian' => '',
            'tera_kembali' => '',

        ]);
        if (in_array('standar', $templateVariables)) {
            $templateProcessor->cloneRowAndSetValues('standar', $standar);
        }
        if (in_array('pennguji', $templateVariables)) {
            $templateProcessor->cloneRowAndSetValues('pennguji', $standar);
        }
        if (in_array('uttp', $templateVariables)) {
            $templateProcessor->cloneRowAndSetValues('uttp', $standar);
        }

        $randomFileName = Str::random(10) . '.docx';

    // Define the path where the file will be temporarily saved in storage/app/generate
    $pathToSave = storage_path('app/generate/' . $randomFileName);

    // Ensure the directory exists, if not create it
    if (!Storage::exists('generate')) {
        Storage::makeDirectory('generate');
    }

        $templateProcessor->saveAs($pathToSave);
        return response()->download($pathToSave)->deleteFileAfterSend(true);

    }
}
