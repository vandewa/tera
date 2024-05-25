<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ComCode;

class ComCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['com_cd' => 'PENGAJUAN_TP_01','code_nm' => 'Di Kantor','code_group' => 'PENGAJUAN_TP', 'code_value' => ''],
            ['com_cd' => 'PENGAJUAN_TP_02','code_nm' => 'Di Lokasi Alat','code_group' => 'PENGAJUAN_TP', 'code_value' => 'Hanya diperuntukkan untuk alat yang tidak bisa dipindah'],
            ['com_cd' => 'PENGAJUAN_ST_01','code_nm' => 'Menunggu Di Setujuai','code_group' => 'PENGAJUAN_ST', 'code_value' => ''],
            ['com_cd' => 'PENGAJUAN_ST_02','code_nm' => 'Diterima','code_group' => 'PENGAJUAN_ST', 'code_value' => ''],
            ['com_cd' => 'PENGAJUAN_ST_03','code_nm' => 'Ditolak','code_group' => 'PENGAJUAN_ST', 'code_value' => ''],
            ['com_cd' => 'PENGAJUAN_ST_04','code_nm' => 'Selesai','code_group' => 'PENGAJUAN_ST', 'code_value' => ''],
            ['com_cd' => 'HASIL_ST_01','code_nm' => 'Sah','code_group' => 'HASIL_ST', 'code_value' => ''],
            ['com_cd' => 'HASIL_ST_02','code_nm' => 'Tidak Sah','code_group' => 'HASIL_ST', 'code_value' => ''],
            ['com_cd' => 'PERALATAN_ST_01','code_nm' => 'Tersedia','code_group' => 'PERALATAN_ST', 'code_value' => ''],
            ['com_cd' => 'PERALATAN_ST_02','code_nm' => 'Dipinjam','code_group' => 'PERALATAN_ST', 'code_value' => ''],
            ['com_cd' => 'PERALATAN_ST_03','code_nm' => 'Rusak','code_group' => 'PERALATAN_ST', 'code_value' => ''],

        ];

            foreach ($data as $item) {
                ComCode::create($item);
            }
    }
}
